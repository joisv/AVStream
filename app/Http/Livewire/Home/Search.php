<?php

namespace App\Http\Livewire\Home;

use App\Models\Post;
use Livewire\Component;

class Search extends Component
{
    public $keyword, $sort = 'created_at';
    public $queryString = ['sort'];
    public $description = 'Temukan jav terbaru, ulasan, trailer, dan informasi lengkap tentang jav favorit Anda. Gunakan alat pencarian kami untuk menemukan jav berdasarkan judul, genre, aktor, sutradara, atau tahun rilis. Nikmati pengalaman sinematik yang tak terlupakan dengan saran jav kami.';

    public function render()
    {
        $posts = $this->getSearchResults();
        return view('livewire.home.search', [
            'posts' => $posts
        ]);
    }

    public function updated()
    {
        $this->getSearchResults();
    }

    public function getSearchResults()
    {
        $keyword = $this->keyword;
        return Post::with(['genres', 'actresses', 'studios'])->search(['title', 'code', 'genres.name', 'actresses.name', 'studios.name'], $keyword)->orderBy($this->sort, 'desc')->paginate(12);
    }
}
