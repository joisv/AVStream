<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public Role $role;

    public $permission,
        $modal = false,
        $name;
        
    public $rules = ['name' => 'required|min:3|unique:roles,name'];

    public $listeners = ['editId' => 'edit'];

    public function render()
    {
        return view('livewire.role.edit');
    }

    public function save()
    {
        $this->validate();

        if ($this->role) {
            
            $this->role->update([
                'name' => $this->name
            ]);
            
        }

        $this->emit('closeModal');
        $this->modal = false;

        // if ($role->hasPermissionTo($this->permission)) {
        //     return back()->with('message', 'permission exist.');
        // }
    }

    public function edit(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->modal = !$this->modal;
    }
}
