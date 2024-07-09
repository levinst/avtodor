<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Faq;

class Faqs extends Component
{
    public $name;
    public $email;
    public $question;

//
    protected $messages = [
        'name.required' => 'Введите имя',
        'name.min' => 'Имя слишком короткое',
        'title.min' => 'Имя слишком короткое',
        'email.email' => 'Введите правильный E-mail',
        'question.required' => 'Введите вопрос',
        'question.min' => 'Введите нормальный вопрос',
    ];
//
    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->question = '';
        $this->resetErrorBag();
    }
//
    public function store()
    {
        $this->validate([
            'name' => 'required|min:2',
            'email' => 'nullable|email',
            'question' => 'required|min:5',
        ]);

        Faq::create([
            'name' => $this->name,
            'email' => $this->email,
            'question' => str_replace("\n", "<br>", $this->question),
        ]);

        $this->resetInput();

        session()->flash('message', 'Вопрос успешно отправлен на модерацию.');
    }
//
    public function render()
    {
        $faqs = Faq::where('published', 1)->orderBy('created_at', 'desc')->get();

        return view('livewire.faqs', [
            'faqs' => $faqs,
        ])->extends('layouts.app');
    }
}
