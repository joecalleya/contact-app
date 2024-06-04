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
route::resource('/contacts',ContactController::class);

// Route::Post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
// Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
// Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
// Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
// Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
// Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
// Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');

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
