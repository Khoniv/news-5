<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => 'Test Article 1',
                'slug' => Str::slug('test-article-1'),
                'desc' => 'Test Article 1',
                'img' => 'default.jpg',
                'views' => 80,
                'status' => '1',
                'publish_date' => Carbon::now()->toDateString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('articles')->insert($articles);
    }
}
