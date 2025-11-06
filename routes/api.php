<?php

use App\Http\Api\AuthController;

use App\Http\Api\TestApiController;
use App\Http\Middleware\IsUserAdmin;
use App\Http\Middleware\IsUserEmployer;
use Illuminate\Support\Facades\Route;


Route::post('/login',[AuthController::class,'login'])->name('api.login');

Route::middleware('auth:sanctum')->group(function () {

   Route::middleware(IsUserAdmin::class)->group(function () {
       Route::get('/logout',[AuthController::class,'logout']);
   });

   Route::middleware(IsUserEmployer::class)->group(function () {
   });
});
Route::middleware(['auth:sanctum',IsUserAdmin::class])->group(function () {
    Route::controller(TestApiController::class)->group(function () {
        Route::get("/test",'index')->name('test.index');
    });
});


