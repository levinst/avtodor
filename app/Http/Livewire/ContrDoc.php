<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ContrDoc as ModelContrDoc;
use Livewire\WithPagination;

class ContrDoc extends Component
{
    use WithPagination;

    public function render()
    {
        $contrdoc = ModelContrDoc::orderBy('created_at', 'desc')->paginate(20);

        return view('livewire.contr-doc', [
            'contrdoc' => $contrdoc,
        ])->extends('layouts.app');
    }
}
