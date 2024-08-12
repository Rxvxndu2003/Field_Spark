<?php

// app/Http/Controllers/PagesController.php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function appointment()
    {
        $instructors = Instructor::all();
        return view('pages.appointment', compact('instructors'));
    }
}