<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ViewController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShowNewsController;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/dashboard', function () {
//     // return 1;
//     return view('/home');
//     // return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

route::get('/dashboard',[HomeController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('categories',CategoryController::class)->middleware(['auth',AdminMiddleware::class]);
Route::resource('news',NewsController::class)->middleware(['auth',AdminMiddleware::class]);

route::get('/view/{id}',[ViewController::class,'index'])->name('view.news');
Route::get('/show/{id}', [ShowNewsController::class, 'show'])->name('news.show');
route::get('user_page',[HomeController::class,'user'])->name('user.page');
route::get('home_page',[HomeController::class,'home'])->name('home.page');


require __DIR__.'/auth.php';





