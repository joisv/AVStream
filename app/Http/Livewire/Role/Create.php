<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $name,
        $permission,
        $modal = false;

    public $listeners = ['openModal' => 'toggleModal'];

    public $rules = ['name' => 'required|min:3|unique:roles,name'];

    public function render()
    {
        return view('livewire.role.create');
    }

    public function save()
    {
        $this->validate();

        $role = Role::create([
            'name' => $this->name
        ]);
        
        // if($role->hasPermissionTo($this->permission)){
        //     return back()->with('message', 'permission exist.');
        // } 
        // $role->givePermissionTo($this->permission);

        $this->emit('closeModal');
        $this->toggleModal();
        $this->name = '';
    }

    public function toggleModal()
    {
        $this->modal = !$this->modal;
    }
}
