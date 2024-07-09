<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\News as ModelNews;
use Livewire\WithPagination;

class News extends Component
{
    use WithPagination;

    public function render()
    {
        $news = ModelNews::orderBy('created_at', 'desc')->paginate(20);

        return view('livewire.news', [
            'news' => $news,
        ])->extends('layouts.app');
    }
}
