<?php

namespace App\Http\Livewire\Payment;

use App\Models\Payment;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;
    
    public $name,
        $description,
        $modal = false;

    public $rules = [
        'name' => 'required|min:3|unique:genres,name',
        'description' => 'max:255|string'
    ];

    public $listeners = [
        'openModal' => 'openModal'
    ];
    
    public function render()
    {
        return view('livewire.payment.create');
    }

    public function save()
    {
        $this->validate();

        Payment::create([
            'name' => $this->name,
            'description' => $this->description
        ]);

        $this->modal = false;
        $this->emit('closeModal');
        $this->alert('success', 'Success create payment method');
        $this->reset(['name', 'description']);
    }

    public function openModal()
    {
        $this->modal = !$this->modal;
    }
}
