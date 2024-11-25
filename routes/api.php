<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\API\NewController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// route::get('/',function(){
//     return 1;
// });


route::get('new',[NewController::class,'index'])->name('new');
route::get('new/{id}',[NewController::class,'show'])->name('show');
route::post('new/store',[NewController::class,'store'])->name('store');
route::post('new/{id}',[NewController::class,'update'])->name('update');
route::delete('new/delete/{id}',[NewController::class,'destroy'])->name('destroy');
