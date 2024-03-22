<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jobs\JobsController;

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
Route::get('/jobs/single/{id}', [App\Http\Controllers\Jobs\JobsController::class, 'single'])->name('single.job');
Route::post('/jobs/save', [App\Http\Controllers\Jobs\JobsController::class, 'savejob'])->name('save.job');
Route::post('/jobs/apply', [App\Http\Controllers\Jobs\JobsController::class, 'jobApply'])->name('apply.job');
Route::get('/categories/single/{name}', [App\Http\Controllers\Categories\CategoriesController::class, 'singleCategory'])->name('categories.single');
Route::get('/users/profile', [App\Http\Controllers\Users\UserControler::class, 'profile'])->name('profile');
Route::get('/users/applications', [App\Http\Controllers\Users\UserControler::class, 'applications'])->name('applications');
Route::get('/users/savedjobs', [App\Http\Controllers\Users\UserControler::class, 'savedJobs'])->name('saved.jobs');
Route::get('/users/edit-details', [App\Http\Controllers\Users\UserControler::class, 'editDetails'])->name('edit.details');
Route::post('/users/edit-details', [App\Http\Controllers\Users\UserControler::class, 'updateDetails'])->name('update.details');
Route::get('/users/edit-cv', [App\Http\Controllers\Users\UserControler::class, 'showCV'])->name('show.cv');
Route::post('/users/edit-cv', [App\Http\Controllers\Users\UserControler::class, 'updateCV'])->name('update.cv');
