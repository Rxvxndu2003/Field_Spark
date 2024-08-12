<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'author', 'text'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
