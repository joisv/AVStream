<?php

namespace App\Http\Livewire\Payment;

use App\Models\Payment;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    
    public $payment,
        $name,
        $description,
        $modal = false;

    public $listeners = ['editId' => 'edit'];

    public $rules = [
        'name' => 'required|min:3|unique:genres,name',
        'description' => 'max:255|string'
    ];

    public function render()
    {
        return view('livewire.payment.edit');
    }


    public function save()
    {
        $this->validate();

        $this->payment->update([
            'name' => $this->name,
            'description' => $this->description
        ]);

        $this->modal = false;
        $this->emit('closeModal');
        $this->alert('success', 'Success create payment method');
        $this->reset(['name', 'description']);
    }

    public function edit(Payment $payment)
    {
        $this->payment = $payment;
        $this->name = $payment->name;
        $this->description = $payment->description;
        $this->modal = true;
    }
}
