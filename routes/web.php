<?php

use App\Http\Controllers\Halo\Halocontroller;
use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;


//views->welcome.blade.php
Route::get('/', function () {
    return view('welcome');
});


/*
Route::get('/halo', function () {
    echo "Halo";
});
*/

/*
//views->coba->halo.blade.php
Route::get('/halo', function () {
    return view('coba.halo');
});
*/

//app->http\Controllers->Halo->Halocontroller
Route::get('/halo1', [Halocontroller::class, 'index1']);
Route::get('/halo2', [Halocontroller::class, 'index2']);

//TutorialToDo
/*
Route::get('/todo', function(){
    return view("todo.app");
});
*/
//get to access the function index//after the function is done return back to 'todo' page
Route::get('/todo', [TodoController::class, 'index'])->name('todo'); 
Route::post('/todo', [TodoController::class, 'store'])->name('todo.post'); 

Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update'); 
Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.delete'); 

