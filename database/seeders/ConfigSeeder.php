<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Config::insert([
            [
                'name' => 'logo',
                'value' => 'logo.png',
            ],
            [
                'name' => 'blogname',
                'value' => 'news5',
            ],
            [
                'name' => 'title',
                'value' => 'Welcome to my blog',
            ],
            [
                'name' => 'caption',
                'value' => 'halo tested',
            ],
            [
                'name' => 'ads_widget',
                'value' => 'adsence',
            ],
            [
                'name' => 'ads_footer',
                'value' => 'adsence',
            ],
            [
                'name' => 'footer',
                'value' => 'News5 Teknologi',
            ],
            ]);
    }
}
