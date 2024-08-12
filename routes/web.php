<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\InstructorAuthController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ResourceController;

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/api/instructors', [InstructorAuthController::class, 'getInstructors'])->name('instructors.get');
Route::get('/api/appointments', [AppointmentController::class, 'getInstructorAppointments']);;
Route::get('/api/instructors/{instructorId}/appointments', [AppointmentController::class, 'getAppointments']);
Route::delete('/api/appointments/{id}', [AppointmentController::class, 'destroy']);
Route::post('/api/appointments/{id}/transfer', [AppointmentController::class, 'transfer']);





Route::get('/instructor/register', function () {
    return view('instructor.register');
})->name('instructor.register');

Route::get('/instructor/login', function () {
    return view('instructor.login');
})->name('instructor.login');

Route::get('/discussion', function () {
    return view('pages.discussion');
})->name('pages.discussion');

Route::get('/idiscussion', function () {
    return view('pages.idiscussion');
})->name('pages.idiscussion');

Route::get('/plantinfo', function () {
    return view('pages.plantinfo');
})->name('pages.plantinfo');

Route::get('/appointment', function () {
    return view('pages.appointment');
})->name('pages.appointment');

Route::get('/appointmentadmin', function () {
    return view('pages.adminappoint');
})->name('pages.adminappoint');

Route::get('/instructorplant', function () {
    return view('pages.instructorplant');
})->name('pages.instructorplant');

Route::get('/resource', function () {
    return view('pages.resource');
})->name('pages.resource');

Route::get('/adminresource', function () {
    return view('pages.adminresource');
})->name('pages.adminresource');

Route::get('/instructors', function () {
    return view('pages.instructors');
})->name('pages.instructors');

Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');
Route::post('/resources/store', [ResourceController::class, 'store'])->name('resources.store');


Route::get('/plant/{id}', [PlantController::class, 'show'])->name('plant.show');

Route::get('/api/user', function() {
    return response()->json(Auth::guard('instructor')->user()->name);
});

Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');


Route::post('/instructor/register', [InstructorAuthController::class, 'register']);
Route::post('/instructor/login', [InstructorAuthController::class, 'login']);


route::post('/login',[UserController::class,'loginUser'])->name('login');
route::get('/register',[TemplateController::class,'index1']);
route::get('/',[TemplateController::class,'index3']);
route::get('/aboutus',[TemplateController::class,'index4']);
route::get('/services',[TemplateController::class,'index5']);
route::get('/plants',[TemplateController::class,'index6']);
route::get('/contactus',[TemplateController::class,'index7']);


Route::post('/plants', [PlantController::class, 'store'])->name('plants.store');
Route::get('/instructorplants', [PlantController::class, 'instructorPlantIndex'])->name('instructor.plants.index');
Route::get('/plantinfo', [PlantController::class, 'index'])->name('pages.plantinfo');
Route::get('/plants', [PlantController::class, 'newPage'])->name('pages.plants');
Route::get('/plants/create', [PlantController::class, 'create'])->name('plants.create');
Route::get('/plants/{id}', [PlantController::class, 'show'])->name('plants.show');
// Route to display the plant edit form
Route::get('/plants/{id}/edit', [PlantController::class, 'edit'])->name('plants.edit');

// Route to handle plant updates
Route::post('/api/plants/{id}', [PlantController::class, 'update']);


// Route to handle plant deletions
Route::delete('/plants/{id}', [PlantController::class, 'destroy'])->name('plants.destroy');

// API route to fetch all plants
Route::get('/plants/api', [PlantController::class, 'apiIndex'])->name('plants.api');

// API route to fetch all resources
Route::get('/resources/api', [ResourceController::class, 'apiIndex'])->name('resources.api');

Route::get('/api/resources', [ResourceController::class, 'index']);

// Route to fetch a single resource
Route::get('/api/resources/{id}', [ResourceController::class, 'show']);

// Route to update a resource
Route::post('/api/resources/{id}', [ResourceController::class, 'update']);

// Route to delete a resource
Route::delete('/api/resources/{id}', [ResourceController::class, 'destroy']);

// routes/web.php

Route::post('/create-zoom-meeting', 'ZoomController@createMeeting')->name('create.zoom.meeting');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
});

Route::middleware('auth:instructor')->group(function () {
    Route::get('/idashboard', function () {
        return view('pages.instructordashboard');
    })->name('pages.instructordashboard');
    Route::get('/instructor/logout', [InstructorAuthController::class, 'logout'])->name('instructor.logout');
});



Route::get('/api/plants', [PlantController::class, 'getPlants'])->name('plants.api');

Route::get('/api/resources', [ResourceController::class, 'getResources'])->name('resources.api');






