<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Content;
use App\Models\Contact;
use Illuminate\Support\Str;

class Dashboard extends Component
{
    public $title, $slug, $text, $selected_id, $tel1, $tel2, $email, $address;
    public $category_id = 2; // Категория Структура
    public $updateMode = false;
    public $openForm = false;

//
    protected $messages = [
        'title.required' => 'Введите название',
        'category_id.required' => 'Выберите категорию',
        'text.required' => 'Введите текст',
    ];
//
    public function resetInput()
    {
        $this->title = '';
        $this->slug = '';
        $this->text = '';
        $this->category_id = 2;
        $this->updateMode = false;
        $this->openForm = false;
        $this->resetErrorBag();
    }
//updated
    public function updated()
    {
        if(!is_null($this->title) && $this->updateMode == false) {
            $this->slug = Str::slug($this->title);
        }
    }
//
    public function updateContact()
    {
        $contacts = Contact::find(1);

        $contacts->update([
            'tel1' => $this->tel1,
            'tel2' => $this->tel2,
            'email' => $this->email,
            'address' => $this->address,
        ]);
    }
//
    public function mount()
    {
        $contacts = Contact::find(1);

        $this->tel1 = $contacts['tel1'];
        $this->tel2 = $contacts['tel2'];
        $this->email = $contacts['email'];
        $this->address = $contacts['address'];
    }
//
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'text' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
        ]);

        Content::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'text' => $this->text,
            'category_id' => $this->category_id,
        ]);

        $this->resetInput();
    }
//
    public function edit($id)
    {
        if($id == 1) {
            $this->category_id = 1; //категория Об учреждении
        }
        $this->openForm = true;

        $model = Content::findOrFail($id);
        $this->selected_id = $id;
        $this->title = $model->title;
        $this->slug = $model->slug;
        $this->text = $model->text;

        $this->updateMode = true;
    }
//
    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'title' => 'required',
            'text' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
        ]);

        if ($this->selected_id != null) {

            $model = Content::find($this->selected_id);

            $model->update([
                'title' => $this->title,
                'slug' => $this->slug,
                'text' => $this->text,
                'category_id' => $this->category_id,
            ]);

            $this->resetInput();
        }
    }
//
    public function delete($id)
    {
        if ($id) {
            Content::find($id)->delete();
        }
    }
//
    public function render()
    {
        $contents = Content::withWhereHas('category', function ($query) {
            $query->where('id', 2);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        return view('livewire.admin.dashboard', [
            'contents' => $contents,
        ])->extends('layouts.admin');
    }
}
