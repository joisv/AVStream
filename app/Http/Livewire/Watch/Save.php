<?php

namespace App\Http\Livewire\Watch;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Save extends Component
{
    use LivewireAlert;
    public $post,
        $user,
        $hasPost = false;

    public function render()
    {
        return view('livewire.watch.save');
    }

    public function savePost()
    {
        if (!auth()->check()) {
            $this->alert('warning', 'You need to login first');
            return;
        }

        try {
            if (!$this->hasPost) {
                $this->user->savedPosts()->attach($this->post->id);
                $this->alert('success', 'Successfully save Jav');
                $this->hasPost = true;
            } else {
                $this->user->savedPosts()->detach($this->post->id);
                $this->alert('success', 'Removed Jav');
                $this->hasPost = false;
            }
            $this->emitSelf('reRender');
        } catch (\Throwable $th) {
            $this->alert('error', $th->getMessage());
        }
    }
}
