<?php

namespace App\Http\Livewire\Watch;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Watch extends Component
{
    use LivewireAlert;

    public $user;

    public $post,
        $download = false,
        $selectedEmbeds,
        $isVip = false,
        $hasPost = false,
        $selected;

    public $rules = [
        'selectedEmbeds' => 'required'
    ];

    public $listeners = ['reRender' => 'reRender'];

    public function reRender()
    {
    }

    public function updated()
    {

        if ($this->selectedEmbeds) {
            $this->selected = json_decode($this->selectedEmbeds, true);
            $this->emitSelf("plyr", $this->selected);
            $this->dispatchBrowserEvent('plyr');
        }
    }

    public function mount()
    {
        $this->selectedEmbeds = $this->post->movies()->exists() ? $this->post->movies[0] : null;
        $this->selected = $this->selectedEmbeds;

        if (auth()->check()) {
            $this->user = auth()->user();
            $this->isPostExis();
        }
    }

    public function render()
    {
        return view('livewire.watch.watch');
    }

    public function alertMe($message, $status = null)
    {
        $this->alert($status ?? 'success', $message, [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function isPostExis()
    {
        $this->hasPost = $this->user->savedPosts()->find($this->post->id) ? true : false;
    }
}
