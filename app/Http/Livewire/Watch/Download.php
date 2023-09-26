<?php

namespace App\Http\Livewire\Watch;

use App\Models\Download as ModelsDownload;
use App\Models\Post;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Download extends Component
{
    use LivewireAlert;

    public $vipDownloads = [],
        $regularDownloads = [],
        $selectedDownload = [];

    public $listeners = ['getDownload' => 'openModal'];
    public $postId;


    public $modal = false;

    public function render()
    {
        return view('livewire.watch.download');
    }

    public function openModal()
    {
        $this->modal = true;
    }

    public function getDownloads()
    {
        $downloads = Post::with('downloads')->find($this->postId)->downloads;

        foreach ($downloads as $donwload) {

            if ($donwload->isVip == 1) {
                $this->vipDownloads[] = $donwload;
            } else {
                $this->regularDownloads[] = $donwload;
            }
        }
    }

    public function download()
    {
        if ($this->selectedDownload) {
            $download = ModelsDownload::where('id', $this->selectedDownload)->select('url_download', 'isVip')->first();

            if ($download->isVip == 1) {
                if (auth()->check() && auth()->user()->can('can premium content')) {
                    $this->dispatchBrowserEvent('open-new-tab', ['open' => $download->url_download]);
                } else {
                    $this->alert('error', 'You need to login or upgrade youre account');
                }
            } else {
                $this->dispatchBrowserEvent('open-new-tab', ['open' => $download->url_download]);
            }
        } else {
            $this->alert('error', 'Select option bellow');
        }
    }
}
