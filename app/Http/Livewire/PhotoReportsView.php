<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PhotoReport;

class PhotoReportsView extends Component
{
    public $photoreports;

    public function mount($slug = null)
    {
        $this->photoreports = PhotoReport::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.photo-reports-view')->extends('layouts.app');
    }
}
