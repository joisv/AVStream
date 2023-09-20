<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public $search = '',
        $sortField = 'created_at',
        $isPaginate = 10,
        $sortDirection = 'desc';

    public $listeners = ['closeModal' => 'refreshData'];

    public function render()
    {
        return view('livewire.role.index', [
            'roles' => Role::search('name', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->isPaginate)
        ]);
    }

    public function sortBy($field)
    {

        if ($this->sortField === $field) {

            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {

            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }
    
    public function createModal()
    {
        $this->emit('openModal');
    }

    public function editModal(Role $role)
    {
        $this->emit('editId', $role);
    }

    public function refreshData()
    {
    }

    public function destroy(Role $role)
    {
        $role->delete();
        $this->emit('showAlert', 'deleted successfuly');
    }
}
