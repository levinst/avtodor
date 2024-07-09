<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Faq;
use Livewire\WithPagination;

class Faqs extends Component
{
    use WithPagination;

    public $name, $question, $answer, $published;
    public $selected_id;
    public $count_q;
    public $openForm = false;

//
    protected $messages = [
        'answer.required' => 'Введите ответ',
        'answer.min' => 'Ответ слишком короткий',
    ];
//
    public function resetInput()
    {
        $this->answer = '';
        $this->published = 0;
        $this->openForm = false;
        $this->resetErrorBag();
    }
//
    public function edit($id)
    {
        $this->openForm = true;

        $model = Faq::findOrFail($id);

        $this->selected_id = $id;
        $this->name = $model->name;
        $this->question = $model->question;
        $this->answer = str_replace("<br>", "\n", $model->answer);
    }
//
    public function update()
    {
        $this->validate([
            'answer' => 'required|min:5',
        ]);

        if ($this->selected_id) {

            $model = Faq::find($this->selected_id);

            $model->update([
                'answer' => str_replace("\n", "<br>", $this->answer),
                'published' => 1,
            ]);

            $this->resetInput();
        }
    }
//
    public function delete($id)
    {
        if ($id) {
            Faq::find($id)->delete();
        }
    }
//
    public function render()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->paginate(10);
        $this->count_q = Faq::where('published', 0)->count();

        return view('livewire.admin.faqs', [
            'faqs' => $faqs,
        ])->extends('layouts.admin');
    }
}
