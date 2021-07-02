<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['text'];

    /**
     * Обратное отношение для доступа к посту
     *
     */
    public function post(){
        return $this->belongsTo(Post::class);
    }

    /**
     * Обратное отношение для доступа к владельцу
     *
     * @return void
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
