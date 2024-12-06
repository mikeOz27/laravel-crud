<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    protected $fillable = ['title', 'content', 'user_id', 'marked'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
