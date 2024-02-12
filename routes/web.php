<?php

use Illuminate\Support\Facades\Route;

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

function getContacts(){
     return[
        1 => ['name'=> 'Joe', 'phone' => '12345678990'],
        2 => ['name'=> 'jake', 'phone' => '12345678990'],
        3 => ['name'=> 'john', 'phone' => '12345678990'],
    ];
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', function () {
    $contacts= getContacts();
    return view('contacts.index',compact('contacts'));
})->name('contacts.index');

Route::get('/contacts/create', function () {
    return view('contacts.create');
})->name('contacts.create');

Route::get('/contacts/{id}', function ($id) {
    $contacts = getContacts();
    $contact = $contacts[$id];
    return view('contacts.show')->with('contact',$contact);;

})->name('contacts.show');

Route::fallback(function(){

    return '<h1>This page doesnt exist</h1>';
});
