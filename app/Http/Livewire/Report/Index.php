<?php

namespace App\Http\Livewire\Report;

use App\Models\Report;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $search = '',
        $sortField = 'created_at',
        $isPaginate = 10,
        $sortDirection = 'desc';

    public $listeners = ['destroy' => 'destroy'];

    public function sortBy($field)
    {

        if ($this->sortField === $field) {

            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {

            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function mount()
    {
        $this->getReportCount();
    }
    
    public function render()
    {
        return view('livewire.report.index', [
            'reports' => Report::with(['post', 'user'])->search('title', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->isPaginate),
        ]);
    }

    public function getReportCount()
    {
        $reports = Report::where('is_new', true)->get();

        foreach ($reports as $report) {
            $report->update([
                'is_new' => false
            ]);
        }
    }
    
    public function destroyAlert($report)
    {
        $this->alert('warning', 'delete this report ?', [
            'position' => 'top-end',
            'timer' => '',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => 'destroy',
            'showCancelButton' => true,
            'onDismissed' => '',
            'data' => [
                'report' => $report
            ]
        ]);
    }

    public function destroy($data)
    {
        $id = $data['data']['report'];
        try {

            $report = Report::find($id);
            $report->delete();
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Post not found', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }
    }
}
