<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

use function Symfony\Component\String\b;

class CreatePoll extends Component
{
    public $title;

    public $options = ['First'];

    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function createPoll()
    {
        $poll = Poll::create([
            'title' => $this->title

        ])->options()->createMany(collect($this->options)->map(fn($option) => ['name' => $option])->all());

        //        foreach ($this->options as $optionName) {
        //            $poll->options()->create(['name' => $optionName]);
        //        }

        $this->reset(['title', 'options']);
    }

}
