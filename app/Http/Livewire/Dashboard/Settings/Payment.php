<?php

namespace App\Http\Livewire\Dashboard\Settings;

use App\Models\Payment as ModelsPayment;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Payment extends Component
{
    use LivewireAlert;
    public ModelsPayment $payment;

    public $payments = [
        ['name' => '', 'description' => '']
    ];
    
    public function render()
    {
        return view('livewire.dashboard.settings.payment');
    }

    public function mount()
    {
        $this->payments = ModelsPayment::all()->map(function ($contact) {
            return ['name' => $contact->name, 'description' => $contact->description];
        })->toArray();

    }

    public function save()
    {
        $this->validate([
            'payments.*.name' => 'required|string|max:255',
            'payments.*.description' => 'required|max:255',
        ]);

        ModelsPayment::truncate();

        foreach ($this->payments as $item) {
            ModelsPayment::create([
                'name' => $item['name'],
                'description' => $item['description']
            ]);
        }
        $this->alert('success', 'payment method saved');
    }

    public function addPayment()
    {
        $this->payments[] = ['name' => '', 'description' => ''];
    }

    public function deletePayment($index)
    {
        unset($this->payments[$index]);
        $this->payments = array_values($this->payments); // Reset array keys
    }

    public function resetPayments()
    {
        $this->payments = [
            ['name' => '', 'description' => '']
        ];
    }
    

}
