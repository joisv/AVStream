<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;
    
    public $listeners = ['closeModal' => 'refreshData', 'destroy' => 'destroy'];

    public $search = '',
        $sortField = 'created_at',
        $isPaginate = 10,
        $modal = false,
        $categoryCount,
        $categoryUpdate,
        $sortDirection = 'desc';
    
    public function render()
    {
        return view('livewire.category.index', [
            'categories' => Category::search('name', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->isPaginate)
        ]);
    }

    public function getCategoryCount()
    {
        $postInfo = Category::selectRaw('COUNT(*) as postCount, MAX(name) as postLatestUpdated')
            ->first();

        $this->categoryCount = $postInfo->postCount;
        $this->categoryUpdate = $postInfo->postLatestUpdated;
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

    public function refreshData(){
        $this->modal = false;
    }

    public function destroyAlert($category)
    {
        $this->alert('warning', 'delete this category ?', [
            'position' => 'top-end',
            'timer' => '',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => 'destroy',
            'showCancelButton' => true,
            'onDismissed' => '',
            'data' => [
                'category' => $category
            ]
        ]);
    }

    public function destroy($data)
    {
        $id = $data['data']['category'];
        try {
            $category = Category::find($id);
            $category->delete();
            $this->emitSelf('closeModal');
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Genre not found', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }
        
    }


    public function toggleModal($category)
    {
        $this->modal = !$this->modal;

        $this->emit('editId', $category);
    }
}
