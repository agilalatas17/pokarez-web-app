<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $judul = [
            'Artikel Satu',
            'Artikel Dua',
            'Artikel Tiga',
            'Artikel Empat',
            'Artikel Lima'
        ];

        foreach($judul as $j) {
            $slug = Str::slug($j);
            $slugOri = $slug;
            $count = 1;

            while(Post::where('slug', $slug)->exists()){
                $slug = $slugOri . '-' . $count;
                $count++;
            }

            Post::create([
                'judul' => $j,
                'slug' => $slug,
                'deskripsi' => 'Deskripsi untuk judul ' . $j,
                'konten' => 'Konten untuk ' . $j,
                'kategori' => 'artikel',
                'status' => 'publish',
                'user_id' => '1',
            ]);
        }
    }
}