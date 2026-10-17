<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutContent extends Model
{
    use HasFactory;

    // Nama tabel (opsional, jika tidak sesuai konvensi Laravel)
    protected $table = 'about_contents';

    // Kolom-kolom yang dapat diisi (mass assignment)
    protected $fillable = [
        'content',
        'phone',
        'mobile',
        'email',
        'address',
    ];
}
