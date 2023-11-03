<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Actress;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Download;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Plan;
use App\Models\Post;
use App\Models\SeoSetting;
use App\Models\Studio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        Post::factory(1)->create();
        Genre::factory(10)->create();
        Actress::factory(20)->create();
        Category::factory(10)->create();
        Movie::factory(10)->create();
        Download::factory(10)->create();
        Contact::factory(3)->create();
        Studio::factory(10)->create();
        SeoSetting::factory(1)->create();
        Plan::factory(3)->create();

        $count = 50;

        for ($i = 0; $i < $count; $i++) {
            $post_id = DB::table('posts')->inRandomOrder()->value('id');
            $genre_id = DB::table('genres')->inRandomOrder()->value('id');

            // Check if the combination already exists
            $existingEntry = DB::table('post_genre')
                ->where('post_id', $post_id)
                ->where('genre_id', $genre_id)
                ->first();

            // If the entry doesn't exist, insert it
            if (!$existingEntry) {
                DB::table('post_genre')->insert([
                    'post_id' => $post_id,
                    'genre_id' => $genre_id,
                ]);
            }
        }
        for ($i = 0; $i < $count; $i++) {
            $post_id = DB::table('posts')->inRandomOrder()->value('id');
            $genre_id = DB::table('genres')->inRandomOrder()->value('id');

            // Check if the combination already exists
            $existingEntry = DB::table('post_genre')
                ->where('post_id', $post_id)
                ->where('genre_id', $genre_id)
                ->first();

            // If the entry doesn't exist, insert it
            if (!$existingEntry) {
                DB::table('post_genre')->insert([
                    'post_id' => $post_id,
                    'genre_id' => $genre_id,
                ]);
            }
        }

        for ($i = 0; $i < $count; $i++) {
            $post_id = DB::table('posts')->inRandomOrder()->value('id');
            $actress_id = DB::table('actresses')->inRandomOrder()->value('id');

            // Check if the combination already exists
            $existingEntry = DB::table('actress_post')
                ->where('post_id', $post_id)
                ->where('actress_id', $actress_id)
                ->first();

            // If the entry doesn't exist, insert it
            if (!$existingEntry) {
                DB::table('actress_post')->insert([
                    'post_id' => $post_id,
                    'actress_id' => $actress_id,
                ]);
            }
        }
        for ($i = 0; $i < $count; $i++) {
            $post_id = DB::table('posts')->inRandomOrder()->value('id');
            $studio_id = DB::table('studios')->inRandomOrder()->value('id');

            // Check if the combination already exists
            $existingEntry = DB::table('post_studio')
                ->where('post_id', $post_id)
                ->where('studio_id', $studio_id)
                ->first();

            // If the entry doesn't exist, insert it
            if (!$existingEntry) {
                DB::table('post_studio')->insert([
                    'post_id' => $post_id,
                    'studio_id' => $studio_id,
                ]);
            }
        }

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            AdminPost::class,
        ]);
    }
}
