<?php

namespace App\Http\Livewire\Home;

use App\Models\Post;
use Livewire\Component;

class Search extends Component
{
    public $keyword, $sort = 'created_at';
    public $queryString = ['sort'];

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
        // $searchTermsArray = explode(' ', $this->keyword);

        // return Post::with(['genres', 'actresses', 'studios', 'categories'])
        // ->where(function ($query) use ($searchTermsArray) {
        //     foreach ($searchTermsArray as $term) {
        //         $query->orWhere(function ($query) use ($term) {
        //             $query->where('title', 'like', '%' . $term . '%')
        //                 ->orWhereHas('genres', function ($query) use ($term) {
        //                     $query->where('name', 'like', '%' . $term . '%');
        //                 })
        //                 ->orWhereHas('actresses', function ($query) use ($term) {
        //                     $query->where('name', 'like', '%' . $term . '%');
        //                 })
        //                 ->orWhereHas('studios', function ($query) use ($term) {
        //                     $query->where('name', 'like', '%' . $term . '%');
        //                 });
        //         });
        //     }
        // })
        // ->orderBy($this->sort, 'desc')
        // ->paginate(12);
        $keyword = $this->keyword;
        return Post::with(['genres', 'actresses', 'studios'])
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhereHas('genres', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('actresses', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('studios', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    });
            })
            ->orderBy($this->sort, 'desc')->paginate(16);
    }
}
