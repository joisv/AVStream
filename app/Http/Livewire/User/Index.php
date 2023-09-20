<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;
    
    public $listeners = ['closeModal' => 'refreshData', 'destroy' => 'destroy'];

    public $search = '',
        $sortField = 'created_at',
        $isPaginate = 10,
        $userCount,
        $userUpdate,
        $sortDirection = 'desc';

    public function render()
    {
        $query = User::with(['roles' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->orderBy($this->sortField, $this->sortDirection);

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('created_at', 'like', '%' . $this->search . '%')
                ->orWhereHas('roles', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
        }

        $users = $query->paginate($this->isPaginate);

        return view('livewire.user.index', [
            'users' => $users
        ]);
    }

    public function getUserCount()
    {
        $postInfo = User::selectRaw('COUNT(*) as postCount, MAX(name) as postLatestUpdated')
            ->first();

        $this->userCount = $postInfo->postCount;
        $this->userUpdate = $postInfo->postLatestUpdated;
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

    public function refreshData()
    {
    }

    public function destroyAlert($user)
    {
        $this->alert('warning', 'delete this user ?', [
            'position' => 'top-end',
            'timer' => '',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => 'destroy',
            'showCancelButton' => true,
            'onDismissed' => '',
            'data' => [
                'user' => $user
            ]
        ]);
    }

    public function destroy($data)
    {
        $id = $data['data']['user'];
        try {
            $user = User::find($id);
            Gate::authorize('delete', $user);
            $user->delete();
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }
            $this->emitSelf('closeModal');
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'User not found', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }
    }

    // public function destroy(User $user)
    // {
    //     Gate::authorize('delete', auth()->user());
    //     $user->delete();

    //     if ($user->avatar) {
    //         Storage::delete($user->avatar);
    //     }
    // }


    public function editModal($user)
    {
        $this->modalEdit = true;
        $this->emit('editId', $user);
    }

    public function createModal()
    {
        $this->modalCreate = true;
        $this->emit('openModal');
    }
}
