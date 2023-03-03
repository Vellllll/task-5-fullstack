<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected function articles(){
        return $this->hasMany(Article::class, 'id', 'category_id');
    }
}
