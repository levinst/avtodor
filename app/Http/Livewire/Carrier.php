<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\InfoCarrier;
use Livewire\WithPagination;

class Carrier extends Component
{
    use WithPagination;

    public function render()
    {
        $carrier = InfoCarrier::orderBy('created_at', 'desc')->paginate(20);

        return view('livewire.carrier', [
            'carrier' => $carrier,
        ])->extends('layouts.app');
    }
}
