<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;
    
    public $modal = false,
        $price,
        $name,
        $description,
        $duration,
        $billing_cycle;

    public $listeners = ['openModal' => 'openModal'];

    public $rules = [
        'name' => 'string|min:3|max:255|unique:plans,name',
        'description' => 'string|min:6|max:500',
        'price' => 'required',
        'duration' => 'required'
    ];

    public function render()
    {
        return view('livewire.plan.create');
    }

    public function save()
    {
        $this->validate();

        Plan::create([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'duration' => $this->duration,
            'billing_cycle' => $this->billing_cycle
        ]);

        $this->modal = false;
        $this->emit('closeModal');
        $this->alert('success', 'Success created plan');
        $this->reset(['price', 'name', 'billing_cycle', 'duration', 'description']);
    }

    public function openModal()
    {
        $this->modal = true;
    }
}
