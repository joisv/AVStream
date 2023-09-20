<?php

namespace App\Http\Livewire\Home;

use App\Models\Genre;
use Livewire\Component;

class RandomGenre extends Component
{
    public $postGenres = [
        ['name' => '', 'genres' => []],
        ['name' => '', 'genres' => []],
        ['name' => '', 'genres' => []]
    ];

    public $isLoading = true,
    $take = 4;
    
    public function render()
    {
        return view('livewire.home.random-genre');
    }

    public function getGenres()
    {
        $uniqueGenreIds = []; // Menyimpan ID genre yang sudah ditampilkan
        foreach ($this->postGenres as &$genre) {
            // Ambil genre secara acak yang belum pernah ditampilkan
            $randomGenre = Genre::whereNotIn('id', $uniqueGenreIds)->inRandomOrder()->first();
            
            if ($randomGenre) {
                $uniqueGenreIds[] = $randomGenre->id; // Simpan ID genre yang sudah ditampilkan
                $genre['name'] = $randomGenre;
                $genre['genres'] = $randomGenre->posts->take(4);
            }
        }
        $this->isLoading = false;
    }
}
