<?php

namespace App\Http\Livewire\Payment;

use App\Models\Payment;
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
        $paymentUpdate,
        $paymentCount,
        $sortDirection = 'desc';   
    
    public function render()
    {
        return view('livewire.payment.index', [
            'payments' => Payment::search('name', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->isPaginate)
        ]);
    }

    public function getPostCount()
    {
        $postInfo = Payment::selectRaw('COUNT(*) as postCount, MAX(name) as postLatestUpdated')
            ->first();

        $this->paymentCount = $postInfo->postCount;
        $this->paymentUpdate = $postInfo->postLatestUpdated;
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

    public function toggleModal($payment)
    {
        $this->emit('editId', $payment);
    }

    public function createModal()
    {
        $this->emit('openModal');
    }

    public function destroyAlert($payment)
    {
        $this->alert('warning', 'delete this payment ?', [
            'position' => 'top-end',
            'timer' => '',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => 'destroy',
            'showCancelButton' => true,
            'onDismissed' => '',
            'data' => [
                'payment' => $payment
            ]
        ]);
    }

    public function destroy($data)
    {
        $id = $data['data']['payment'];
        try {
            $payment = Payment::find($id);
            $payment->delete();
            $this->emitSelf('closeModal');
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Payment not found', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }
        
    }
}
