<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\CommentController;


use Illuminate\Support\Facades\Route;

enum Section : string{
    case phone ="phone";
    case laptop ="laptop";
    case computer ="computer";
}

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


Route::get('testing', function() {return view('categories.create');});

//this is a way to group many routes related to a certain controller
Route::controller(CategoryController::class)->group(function(){
    Route::get("category/hello","index");
    Route::get("category/cr","create");
});

//this is the way you used to do in the event brite project with native php
Route::get("testa", [CategoryController::class, 'index']);

// //to make subdomain routes
// Route::domain('{account}.weekly')->group(function($account){
//     Route::get('example','index');
// });

//to give a route a specific routes like : products/?, dik "?" ghankhliwha t9bel ghir chi valeurs mo7adadin o ila khrjna 3lihom o ktbna haja akhra ghay3tina 404;
Route:: get('products/{section}', function(Section $section){
    $array=["hello","letsgo"];
    dd($array) ;
    return $section->value; // or the page view you want to show
});


//Actuall project routes ---------------------------

Route::resource('categories', CategoryController::class);

Route::resource('annonces', AnnonceController::class);
Route::post('annonces/{annonce}/comments', [CommentController::class, 'store'])->name('comments.store');


require __DIR__.'/auth.php';
