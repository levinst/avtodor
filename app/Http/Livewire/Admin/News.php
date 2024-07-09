<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\News as ModelNews;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

class News extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $title, $slug, $text, $selected_id, $image, $created_at;
    public $updateMode = false;
    public $iteration = 1;
    public $openForm = false;
    public $searchTerm;
//
    protected $messages = [
        'title.required' => 'Введите заголовок',
        'title.min' => 'Заголовок слишком короткий',
        'slug.required' => 'Введите алиас',
        'image.image' => 'Только изображения',
        'image.max' => 'Максимальный размер 1Мб',
        'text.required' => 'Введите текст',
        'text.min' => 'Введите нормальный текст',
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
        $this->slug = '';
        $this->text = '';
        $this->image = NULL;
        $this->updateMode = false;
        $this->openForm = false;
        $this->iteration++;
        $this->created_at = now()->format('d.m.Y');
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
    public function mount()
    {
        $this->created_at = now()->format('d.m.Y');
    }
//
    public function store()
    {
        $this->validate([
            'title' => 'required|min:5',
            'text' => 'required|min:5',
            'slug' => 'required|min:5',
        ]);

        if($this->image) {
            $image = time().'.'.$this->image->extension();
            $this->image->storeAs('public/images/news', $image);

            $tmpPhoto = Image::make(storage_path('app/public/images/news/'.$image));
            $tmpPhoto->widen(1024);
            $tmpPhoto->save(storage_path('app/public/images/news/'.$image));

            $tmpPhoto = Image::make(storage_path('app/public/images/news/'.$image));
            $tmpPhoto->widen(390);
            $tmpPhoto->save(storage_path('app/public/images/news/thumbs/'.$image));
        } else {
            $image = NULL;
        }

        ModelNews::create([
            'title' => $this->title,
            'slug' => time().'-'.$this->slug,
            'image' => $image,
            'text' => $this->text,
            'created_at' => $this->created_at,
        ]);

        $this->resetInput();
    }
//
    public function edit($id)
    {
        $this->openForm = true;

        $model = ModelNews::findOrFail($id);
        $this->selected_id = $id;
        $this->title = $model->title;
        $this->slug = $model->slug;
        $this->text = $model->text;
        $this->created_at = Carbon::createFromDate($model->created_at)->format('d.m.Y');
        // $this->image = $model->image;

        $this->updateMode = true;
    }
//
    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'title' => 'required|min:5',
            'text' => 'required|min:5',
            'slug' => 'required|min:5',
            'image' => 'Nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($this->selected_id != null) {

            $model = ModelNews::find($this->selected_id);

            if($this->image) {

                if (file_exists(storage_path('app/public/images/news/'.$model['image']))) {
                    if(!is_null($model['image'])) {
                        unlink(storage_path('app/public/images/news/'.$model['image']));
                    }
                }
                if (file_exists(storage_path('app/public/images/news/thumbs/'.$model['image']))) {
                    if(!is_null($model['image'])) {
                        unlink(storage_path('app/public/images/news/thumbs/'.$model['image']));
                    }
                }

                $image = time().'.'.$this->image->extension();
                $this->image->storeAs('public/images/news', $image);

                $tmpPhoto = Image::make(storage_path('app/public/images/news/'.$image));
                $tmpPhoto->widen(1024);
                $tmpPhoto->save(storage_path('app/public/images/news/'.$image));

                $tmpPhoto = Image::make(storage_path('app/public/images/news/'.$image));
                $tmpPhoto->widen(390);
                $tmpPhoto->save(storage_path('app/public/images/news/thumbs/'.$image));
            }else{
                $image = $model['image'];
            }

            $model->update([
                'title' => $this->title,
                'slug' => $this->slug,
                'text' => $this->text,
                'image' => $image,
                'created_at' => $this->created_at,
            ]);

            $this->resetInput();
        }
    }
//
    public function delete($id)
    {
        if ($id) {

            $model = ModelNews::find($id);

            if(!is_null($model['image'])) {
                if (file_exists(storage_path('app/public/images/news/'.$model['image']))) {
                    unlink(storage_path('app/public/images/news/'.$model['image']));
                }
                if (file_exists(storage_path('app/public/images/news/thumbs/'.$model['image']))) {
                    unlink(storage_path('app/public/images/news/thumbs/'.$model['image']));
                }
            }

            ModelNews::find($id)->delete();
        }
    }

//
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';

        $news = ModelNews::where('title', 'like', $searchTerm)->orderBy('created_at', 'desc')->paginate(30);

        return view('livewire.admin.news', [
            'news' => $news,
        ])->extends('layouts.admin');
    }
}
