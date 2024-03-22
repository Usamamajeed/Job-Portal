<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jobs\JobsController; //We add the Full path here
use App\Http\Controllers\Categories\CategoriesController; //We add the Full path here
use App\Http\Controllers\Users\UserControler; //We add the Full path here

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'jobs'], function () {
    //We use only JobsCOntroller name not all App\Http\Controllers\Jobs\JobsController bcz we add it to the starting
    Route::get('single/{id}', [JobsController::class, 'single'])->name('single.job');
    Route::post('save', [JobsController::class, 'savejob'])->name('save.job');
    Route::post('apply', [JobsController::class, 'jobApply'])->name('apply.job');
});



Route::group(['prefix' => 'categories'], function () {
    //We use only CategoriesController name not all App\Http\Controllers\Categories\CategoriesController bcz we add it to the starting
    Route::get('single/{name}', [CategoriesController::class, 'singleCategory'])->name('categories.single');
});

Route::group(['prefix' => 'users'], function () {
    //We use only UserControler name not all App\Http\Controllers\Users\UserControler bcz we add it to the starting
    Route::get('profile', [UserControler::class, 'profile'])->name('profile');
    Route::get('applications', [UserControler::class, 'applications'])->name('applications');
    Route::get('savedjobs', [UserControler::class, 'savedJobs'])->name('saved.jobs');
    Route::get('edit-details', [UserControler::class, 'editDetails'])->name('edit.details');
    Route::post('edit-details', [UserControler::class, 'updateDetails'])->name('update.details');
    Route::get('edit-cv', [UserControler::class, 'showCV'])->name('show.cv');
    Route::post('edit-cv', [UserControler::class, 'updateCV'])->name('update.cv');
    Route::get('edit-profile-image', [UserControler::class, 'showImage'])->name('show.image');
    Route::post('edit-profile-image', [UserControler::class, 'updateImage'])->name('update.image');
});
