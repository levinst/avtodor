<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Content;

class ContentView extends Component
{
    public $content;

    public function mount($slug = null)
    {
        $this->content = Content::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.content-view')->extends('layouts.app');
    }
}
