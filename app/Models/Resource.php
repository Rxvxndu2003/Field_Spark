<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{

    protected $fillable = [
        'title', 'description', 'image','instructor_id'
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}



