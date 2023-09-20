<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    
    public Plan $plan;
    public $modal = false,
        $price,
        $name,
        $description,
        $duration,
        $billing_cycle;

    public $rules = [
        'description' => 'string|min:6|max:500',
        'price' => 'required',
        'duration' => 'required',
    ];

    protected function rules()
    {   
        $name = $this->name !== $this->plan->name
            ? 'string|min:3|max:255|unique:plans,name,{$planId}'
            : 'string|min:3|max:255';

        return array_merge($this->rules, ['name' => $name]);
    }
    
    public $listeners = ['edit' => 'edit'];

    public function render()
    {
        return view('livewire.plan.edit');
    }

    public function save()
    {
        $this->validate();

        $this->plan->update([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'duration' => $this->duration,
            'billing_cycle' => $this->billing_cycle
        ]);

        $this->modal = false;
        $this->emit('closeModal');
        $this->alert('success', 'Plan updated');
        $this->reset(['price', 'name', 'billing_cycle', 'duration', 'description']);
    }

    public function edit(Plan $plan) {
        
        $this->plan = $plan;
        $this->name = $plan->name;
        $this->price = $plan->price;
        $this->duration = $plan->duration;
        $this->description = $plan->description;
        $this->billing_cycle = $plan->billing_cycle;
        $this->modal = true;
        
    }
}
