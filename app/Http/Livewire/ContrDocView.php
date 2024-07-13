<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ContrDoc;

class ContrDocView extends Component
{
    public $contrdoc;

    public function mount($slug = null)
    {
        $this->contrdoc = ContrDoc::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.contr-doc-view')->extends('layouts.app');
    }
}
