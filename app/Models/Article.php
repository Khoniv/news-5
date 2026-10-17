<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $fillable = ['user_id','category_id', 'title', 'slug', 'desc', 'img', 'views', 'status', 'publish_date'];

    
    //Relasi User
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Relasi Table Categories
    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
