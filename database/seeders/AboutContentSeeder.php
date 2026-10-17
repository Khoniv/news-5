<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutContent::create([
            'content' => 'NewsFive adalah platform berita yang didedikasikan untuk menyajikan informasi terkini, akurat, dan terpercaya.
            Sejak awal berdiri, NewsFive berkomitmen untuk menjadi sumber utama berita bagi masyarakat, dengan menghadirkan artikel dari berbagai topik seperti politik, teknologi, hiburan, olahraga, dan gaya hidup.
            Kami percaya pada pentingnya jurnalisme yang transparan dan berimbang. Dengan tim penulis dan jurnalis berpengalaman, NewsFive terus berupaya memberikan berita yang relevan dan menarik bagi pembaca di era digital ini. Visi kami adalah menciptakan masyarakat yang lebih cerdas dan terinformasi melalui berita yang berkualitas. Bergabunglah dengan jutaan pembaca lainnya yang mempercayai NewsFive sebagai sumber berita utama mereka.',
            'phone' => '021-1234567',
            'mobile' => '081234567890',
            'email' => 'info@example.com',
            'address' => 'Jl. Sudirman No.1, Jakarta',
        ]);
    }
}
