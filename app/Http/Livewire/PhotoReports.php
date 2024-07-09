<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PhotoReport;
use Livewire\WithPagination;

class PhotoReports extends Component
{
    use WithPagination;

    public function render()
    {
        $photoreports = PhotoReport::orderBy('created_at', 'desc')->paginate(20);

        return view('livewire.photo-reports', [
            'photoreports' => $photoreports,
        ])->extends('layouts.app');
    }
}
