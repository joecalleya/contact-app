<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactNoteController;
use App\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

route::controller(ContactController::class)->name('contacts.')->group(function(){
    Route::get('/contacts', [ContactController::class, 'index'])->name('index');
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('create');
    Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('show');
});

route::resource('/companies',CompanyController::class);
route::resources
    ([
        '/tags' => TagController::class,
        '/tasks' => TaskController::class
    ]);

Route::resource('/activities', ActivityController::class)->except([
    'except','store','edit', 'update', 'destroy'
]);
route::resource('/contacts.note', ContactNoteController::class)->shallow();

// rename
Route::resource('/activities', ActivityController::class)->names([
    'index' => 'activities.all',
    'show' => 'activities.view'
]);

// rename
Route::resource('/activities', ActivityController::class)->parameters([
    'activities' => 'active'
]);
