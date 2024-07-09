<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category as ModelCategory;

class Category extends Component
{
    public $category;

//
    public function mount($slug = null)
    {
        $this->category = ModelCategory::with('contents')->where('slug', $slug)->firstOrFail();
    }
//
    public function render()
    {
        return view('livewire.category')->extends('layouts.app');
    }
}
