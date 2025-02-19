<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return "<h1>hello this is me</h1>";
});

//apply the prefix grouping 
Route::prefix("product")->group(function() {
    Route::get('create',function(){return "<h1>create the product</h1>";});
    Route::get('details',function(){return "<h1>details of product</h1>";});
});

Route::get('data/{id?}', function ($id=null) {
    return "<h1>hello this is me $id</h1>";
})->whereIn('id',['yas','yos','boss']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('testing', function() {return view('categories.create');});

//this is a way to group many routes related to a certain controller
Route::controller(CategoryController::class)->group(function(){
    Route::get("hello","index");
    Route::get("category/create","create");
});

//Actuall project routs ---------------------------

Route::resource('categories', CategoryController::class);


require __DIR__.'/auth.php';
