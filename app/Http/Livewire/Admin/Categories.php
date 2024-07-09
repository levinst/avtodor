<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class Categories extends Component
{
    public $title, $slug, $text, $selected_id;
    public $updateMode = false;
    public $openForm = false;
    public $searchTerm;

//
    protected $messages = [
        'title.required' => 'Введите заголовок',
        'title.min' => 'Заголовок слишком короткий',
        'slug.required' => 'Введите алиас',
        'text.min' => 'Введите нормальный текст',
    ];
//
    public function resetInput()
    {
        $this->title = '';
        $this->slug = '';
        $this->text = '';
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
    public function store()
    {
        $this->validate([
            'title' => 'required|min:5',
            'text' => 'nullable|min:5',
            'slug' => 'required|min:5',
        ]);

        Category::create([
            'title' => $this->title,
            'slug' => time().'-'.$this->slug,
            'text' => $this->text,
        ]);

        $this->resetInput();
    }
    //
    public function edit($id)
    {
        $this->openForm = true;

        $model = Category::findOrFail($id);
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
            'title' => 'required|min:5',
            'text' => 'nullable|min:5',
            'slug' => 'required|min:5',
        ]);

        if ($this->selected_id != null) {

            $model = Category::find($this->selected_id);

            $model->update([
                'title' => $this->title,
                'slug' => $this->slug,
                'text' => $this->text,
            ]);

            $this->resetInput();
        }
    }
//
    public function delete($id)
    {
        if ($id) {

            $category = Category::find($id);
            $category->contents()->delete();
            $category->delete();

        }
    }
//
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';

        $categories = Category::where('title', 'like', $searchTerm)->where('published', 1)->orderBy('id', 'asc')->get();

        return view('livewire.admin.categories', [
            'categories' => $categories,
        ])->extends('layouts.admin');
    }
}
