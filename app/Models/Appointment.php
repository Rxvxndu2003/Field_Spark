<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'contact_number',
        'instructor_id',
        'date',
        'time',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
