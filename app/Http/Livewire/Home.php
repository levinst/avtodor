<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\News;
use App\Models\PhotoReport;

class Home extends Component
{
    public function render()
    {
        $news = News::orderBy('created_at', 'desc')->limit(5)->get();
        $photoreports = PhotoReport::orderBy('created_at', 'desc')->limit(9)->get();

        return view('livewire.home', [
            'news' => $news,
            'photoreports' => $photoreports,
        ])->extends('layouts.app');
    }
}
