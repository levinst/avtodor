<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Banner;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Banners extends Component
{
    use WithFileUploads;

    public $title;
    public $url;
    public $image;
    public $code;
    public $type = 0;
    public $iteration = 1;

//
protected $messages = [
    'title.required' => 'Введите заголовок',
];
//
public function resetInput()
{
    $this->title = '';
    $this->url = '';
    $this->image = NULL;
    $this->code = '';
    $this->type = 0;
    $this->iteration++;
    $this->resetErrorBag();
}
//
    public function updateBannerOrder($items)
    {
        foreach($items as $item) {
            Banner::find($item['value'])->update(['ordering' => $item['order']]);
        }
    }
//
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,gif',
        ]);

        if($this->image != null) {
            $image = $this->image->store('public/images/banners');
        }else{
            $image = null;
        }

        Banner::create([
            'title' => $this->title,
            'url' => $this->url,
            'image' => $image,
            'code' => $this->code,
            'type' => $this->type,
        ]);

        $this->resetInput();
    }
//
    public function delete($id)
    {
        if ($id) {

            $model = Banner::find($id);

            if($model['image'] != null) {
                Storage::delete($model['image']);
            }

            Banner::find($id)->delete();
        }
    }

//
    public function render()
    {
        $banners = Banner::orderBy('ordering', 'asc')->get();

        return view('livewire.admin.banners', [
            'banners' => $banners,
        ])->extends('layouts.admin');
    }
}
