<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected function categories(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
