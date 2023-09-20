<?php

namespace App\Http\Livewire\Watch;

use App\Models\SeoSetting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Watch extends Component
{
    use LivewireAlert;

    public $user;
    
    public $post,
        $download = false,
        $selectedEmbeds,
        $isVip = false,
        $hasPost = false;

    public $rules = [
        'selectedEmbeds' => 'required'
    ];

    public $listeners = [ 'reRender' => 'reRender' ];

    public function reRender(){

    }
    
    public function mount()
    {
        $this->selectedEmbeds = $this->post->movies()->exists() ? $this->post->movies[0] : null;
        if (auth()->check()) {
            $this->user = auth()->user();
            $this->isPostExis();
        }
    }

    public function render()
    {
        SEOTools::setTitle(''.( $this->post->code ?? '') .' | ' . $this->post->title . '', false);
        SEOTools::setDescription($this->post->overview);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current() . '?slug=' . $this->post->slug);
        SEOTools::opengraph()->addProperty('type', 'video.movie');
        SEOTools::opengraph()->setTitle($this->post->title);
        SEOTools::opengraph()->setDescription($this->post->overview);
        SEOTools::opengraph()->addImage($this->post->poster_path);
        SEOTools::twitter()->setTitle($this->post->title);
        SEOTools::twitter()->setDescription($this->post->overview);
        SEOTools::twitter()->setImage($this->post->poster_path);
        SEOMeta::setRobots('index, follow');
        // SEOMeta::setKeywords('')

        return view('livewire.watch.watch');
    }

    public function alertMe($message, $status = null)
    {
        $this->alert($status ?? 'success', $message, [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function getDownload()
    {
        $this->emitTo('watch.download', 'getDownload');
    }

    public function reportIssue()
    {
        $this->emitTo('watch.report-issue', 'reportIssue');
    }

    public function savePost()
    {
        if (!auth()->check()) {
            $this->alert('warning', 'You need to login first');
            return;
        }
    
        try {
            if (!$this->hasPost) {
                $this->user->savedPosts()->attach($this->post->id);
                $this->alert('success', 'Successfully save Jav');
                $this->hasPost = true;
            } else {
                $this->user->savedPosts()->detach($this->post->id);
                $this->alert('success', 'Removed Jav');
                $this->hasPost = false;
            }
            $this->emitSelf('reRender');
        } catch (\Throwable $th) {
            $this->alert('error', $th->getMessage());
        }
    }

    public function isPostExis()
    {
        $this->hasPost = $this->user->savedPosts()->find($this->post->id) ? true : false;
    }
}
