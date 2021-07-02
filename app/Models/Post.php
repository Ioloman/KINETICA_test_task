<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text'];

    /**
     * Отношение один ко многим для доступа к комментариям
     *
     */
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    /**
     * Обратное отношение для доступа к владельцу поста
     *
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
