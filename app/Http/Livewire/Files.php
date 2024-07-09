<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\File;
use Livewire\WithPagination;


class Files extends Component
{
    use WithPagination;

    public $category;

    public function mount($category = null)
    {
        // File::where('category', $category)->firstOrFail();

        if($category == "docs" || $category == "roads" || $category == "blanks" || $category == "korrup" ) {
            $this->category = $category;
        }else{
           abort(404);
        }

    }

    public function render()
    {
        $files = File::where('category', $this->category)->orderBy('created_at', 'desc')->paginate(20);
// dd($files);
        return view('livewire.files', [
            'files' => $files,
        ])->extends('layouts.app');
    }
}
