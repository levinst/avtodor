<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\File;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Files extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $category = 'docs';
    public $title;
    public $filename;
    public $text;
    public $created_at;
    public $selected_id;
    public $iteration = 1;
    public $updateMode = false;
    public $openForm = false;
    public $searchTerm;
    public $filterTerm;

//
    protected $messages = [
        'title.required' => 'Введите заголовок',
        'title.min' => 'Заголовок слишком короткий',
        'filename.required' => 'Выберите файл',
        'filename.file' => 'Только файлы',
        'filename.mimes' => 'Такой тип файлов не поддерживается',
        'filename.max' => 'Максимальный размер 10Мб',
        'category.required' => 'Выберите категорию',
    ];
// при изменении datepicker присваивать дату input
    protected $listeners = ['dateSelected' => 'updateDate'];

    public function updateDate($date)
    {
        $this->created_at = date('d.m.Y', strtotime($date));
    }
//
    public function resetInput()
    {
        $this->title = '';
        $this->category = 'docs';
        $this->filename = NULL;
        $this->text = '';
        $this->updateMode = false;
        $this->openForm = false;
        $this->iteration++;
        $this->created_at = now()->format('d.m.Y');
        $this->resetErrorBag();
    }
//
    public function mount()
    {
        $this->created_at = now()->format('d.m.Y');
    }
//
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'category' => 'required',
            'filename' => 'required|file|mimes:jpg,png,pdf,txt,csv,zip,7zip,doc,docx,xls,xlsx',
        ]);

        //if($this->filename) {
            $filename = $this->filename->store('public/files');
        //}

        File::create([
            'title' => $this->title,
            'category' => $this->category,
            'filename' => $filename,
            'text' => $this->text,
            'created_at' => $this->created_at,
        ]);

        $this->resetInput();
    }
//
    public function edit($id)
    {
        $this->openForm = true;

        $model = File::findOrFail($id);

        $this->selected_id = $id;
        $this->title = $model->title;
        $this->category = $model->category;
        $this->text = $model->text;
        $this->created_at = Carbon::createFromDate($model->created_at)->format('d.m.Y');
        // $this->image = $model->image;

        $this->updateMode = true;
    }
//
    public function update()
    {
        $this->validate([
            'title' => 'required',
            'category' => 'required',
            'filename' => 'nullable|file|mimes:jpg,png,pdf,txt,csv,zip,7zip,doc,docx,xls,xlsx',
        ]);

        if ($this->selected_id) {

            $model = File::find($this->selected_id);

            if($this->filename != null) {

                Storage::delete($model['filename']);
                $filename = $this->filename->store('public/files');

            }else{
                $filename = $model['filename'];
            }

            $model->update([
                'title' => $this->title,
                'category' => $this->category,
                'filename' => $filename,
                'text' => $this->text,
                'created_at' => $this->created_at,
            ]);

            $this->resetInput();
        }
    }
//
    public function delete($id)
    {
        if ($id) {

            $model = File::find($id);

            Storage::delete($model['filename']);
            File::find($id)->delete();
        }
    }
//
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $filterTerm = '%'.$this->filterTerm.'%';

        $files = File::where('title', 'like', $searchTerm)
        ->where('category', 'like', $filterTerm)
        ->orderBy('created_at', 'desc')->paginate(30);

        return view('livewire.admin.files', [
            'files' => $files,
        ])->extends('layouts.admin');
    }
}
