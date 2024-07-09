<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\InfoCarrier;

class CarrierView extends Component
{
    public $carrier;

    public function mount($slug = null)
    {
        $this->carrier = InfoCarrier::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.carrier-view')->extends('layouts.app');
    }
}
