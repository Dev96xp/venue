<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::factory(2)->create();
        foreach ($posts as $post) {
            Image::factory(1)->create([
                'model' => 'nada',
                'imageable_id' => $post->id,
                'imageable_type' => 'App\Models\Post'
            ]);
            $post->tags()->attach([
                rand(1, 4),         // Asigna etiquetas al azar, un numero entre 1 y el 4
                rand(5, 8)          // Asigna etiquetas al azar, un numero entre 5 y el 8
            ]);
        }

    }
}
