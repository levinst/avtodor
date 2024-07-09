<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\News;

class NewsView extends Component
{
    public $news;

    public function mount($slug = null)
    {
        $this->news = News::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.news-view')->extends('layouts.app');
    }
}
