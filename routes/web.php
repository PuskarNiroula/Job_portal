<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Emp\EmpController;
use App\Http\Controllers\Emp\JobController;
use App\Http\Controllers\Job\JobSeekerController;
use App\Http\Controllers\Job\JobSeekerProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsUserAdmin;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\IsUserEmployer;
use App\Http\Middleware\IsUserJobSeeker;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [AuthenticatedSessionController::class, 'dashboard'])->middleware('auth','verified')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(IsUserAdmin::class)->group(function () {
        Route::controller(AdminController::class)->group(callback: function () {
            Route::get('/admin', 'index')->name('admin.index');
        });
    });

    Route::middleware(IsUserEmployer::class)->group(function () {
        Route::controller(EmpController::class)->group(callback: function () {
            Route::get('/employer', 'index')->name('emp.index');
            Route::get('/employer/post_job', 'postJob')->name('emp.create');

        });
        Route::controller(JobController::class)->group( function () {
            Route::post('/employer/store', 'store')->name('emp.store');
            Route::delete('/employer/delete/{id}', 'delete')->name('emp.delete');
            Route::get('/employer/getJobs', 'getJobs')->name('emp.getJobs');
            Route::get('/employer/edit_job/{id}', 'edit')->name('emp.edit');
            Route::put('/employer/update_job/{id}', 'update')->name('emp.update');
        });
    });

    Route::middleware(IsUserJobSeeker::class)->group(function () {
        Route::controller(JobSeekerController::class)->group(function(){
            Route::get('/jobseeker', 'index')->name('jobseeker.index');
            Route::get('/jobseeker/getJobs', 'getJobs')->name('jobseeker.getJobs');
            Route::get('/jobseeker/edit', 'completeProfile')->name('jobseeker.edit');
        });
        Route::controller(JobSeekerProfileController::class)->group(function(){
            Route::post('/jobseeker/store', 'edit')->name('jobseeker.store');
            Route::get('/jobseeker/profile', 'view')->name('jobseeker.profile');
        });
    });
});

require __DIR__.'/auth.php';
