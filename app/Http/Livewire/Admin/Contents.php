<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Content;
use App\Models\Category;
use Illuminate\Support\Str;

class Contents extends Component
{

    public $title, $slug, $text, $category_id, $selected_id;
    public $updateMode = false;
    public $openForm = false;
    public $searchTerm;

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
        $this->category_id = '';
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
            'title' => 'required',
            'text' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
        ]);

        Content::create([
            'title' => $this->title,
            'slug' => time().'-'.$this->slug,
            'text' => $this->text,
            'category_id' => $this->category_id,
        ]);

        $this->resetInput();
    }
//
    public function edit($id)
    {
        $this->openForm = true;

        $model = Content::findOrFail($id);
        $this->selected_id = $id;
        $this->title = $model->title;
        $this->slug = $model->slug;
        $this->text = $model->text;
        $this->category_id = $model->category_id;

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
        $searchTerm = '%'.$this->searchTerm.'%';

        $contents = Content::withWhereHas('category', function ($query) {
            $query->where('published', true);
        })
        ->where('title', 'like', $searchTerm)
        ->orderBy('created_at', 'asc')
        ->get();

        return view('livewire.admin.contents', [
            'contents' => $contents,
        ])->extends('layouts.admin');
    }
}
