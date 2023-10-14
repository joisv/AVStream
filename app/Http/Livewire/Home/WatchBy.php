<?php

namespace App\Http\Livewire\Home;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class WatchBy extends Component
{
    use WithPagination;
    public $keyword , $sort = 'created_at';

    protected $queryString = ['sort'];

    public function updated($propertyName)
    {
        $this->condition();
    }

    public function render()
    {
        $post = $this->condition();

        return view('livewire.home.watch-by', [
            'posts' => $post
        ]);
    }

    public function condition()
    {
        $post = null;
        switch ($this->keyword) {
            case 'most_watch_today':
                $post = $this->getMostViewedPosts(Carbon::now()->subDay(), Carbon::now());
                break;
            case 'most_watch_week':
                $post = $this->getMostViewedPosts(Carbon::now()->subWeek(), Carbon::now());
                break;
            case 'most_watch_month':
                $post = $this->getMostViewedPosts(Carbon::now()->subMonth(), Carbon::now());
                break;
            default:
                $post = $this->getPost();
                break;
        }

        return $post;
    }
    
    public function getPost()
    {
        return Post::select(['id', 'slug', 'title', 'poster_path', 'isVip'])->orderBy($this->keyword, 'desc')->paginate(12);
    }

    function getMostViewedPosts($startDate = null, $endDate = null, $orderBy = 'views')
    {
        return DB::table('posts')
            ->select(['id', 'slug', 'title', 'poster_path', 'isVip'])
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->orderByDesc($orderBy)
            ->paginate(12);
    }
}
