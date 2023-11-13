<?php

namespace App\Http\Livewire\Watch;

use App\Models\Report;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ReportIssue extends Component
{
    use LivewireAlert;
    
    public $post_id,
    $content = 'Video disconnects or stops abruptly';
    
    public $rules = [
        'post_id' => 'required',
        'content' => 'required|string|min:5'
    ] ;
    
    public function render()
    {
        return view('livewire.watch.report-issue');
    }

    public function save()
    {
        if (auth()->check()) {
            
            try {
                $this->validate();

                Report::create([
                    'user_id' => auth()->user()->id,
                    'post_id' => $this->post_id,
                    'content' => $this->content,
                    'is_new' => true,
                    'status' => 'open'
                ]);
                $this->dispatchBrowserEvent('closemodal');
                $this->alert('success', 'Report sent successfully');
                
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Tampilkan pesan kesalahan validasi jika diperlukan
                $errors = $e->validator->getMessageBag();
                foreach ($errors->all() as $error) {
                    $this->alert('error', $error);
                }
                return;
            }
           
        } else {
            $this->dispatchBrowserEvent('open-modal', 'close-modal');
           $this->alert('error', 'Login first');
        }
    }
}
