<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jobs\JobsController; //We add the Full path here
use App\Http\Controllers\Categories\CategoriesController; //We add the Full path here
use App\Http\Controllers\Users\UserControler; //We add the Full path here
use App\Http\Controllers\HomeController; //We add the Full path here
use App\Http\Controllers\Admins\AdminsController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::group(['prefix' => 'jobs'], function () {
    //We use only JobsCOntroller name not all App\Http\Controllers\Jobs\JobsController bcz we add it to the starting
    Route::get('single/{id}', [JobsController::class, 'single'])->name('single.job');
    Route::post('save', [JobsController::class, 'savejob'])->name('save.job');
    Route::post('apply', [JobsController::class, 'jobApply'])->name('apply.job');
    Route::any('search', [JobsController::class, 'search'])->name('search.job');
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

Route::get('admin/login', [AdminsController::class, 'viewLogin'])->name('view.login')->middleware('checkforauth');
//middleware('checkforauth') this can be any name checkforauth which is define in kernel.php file


Route::post('admin/login', [AdminsController::class, 'checkLogin'])->name('check.login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () { //We add middleware on guard name admin to check if admin then access this route guard is in config>auth
    Route::get('/', [AdminsController::class, 'index'])->name('admins.dashboard');
    Route::get('/all-admins', [AdminsController::class, 'admins'])->name('view.admins');
    Route::get('/create-admins', [AdminsController::class, 'createAdmins'])->name('create.admins');
    Route::post('/create-admins', [AdminsController::class, 'storeAdmins'])->name('store.admins');
    Route::get('/display-categories', [AdminsController::class, 'displayCategories'])->name('display.categories');
    Route::get('/create-category', [AdminsController::class, 'createCategories'])->name('create.categories');
    Route::post('/create-category', [AdminsController::class, 'storeCategories'])->name('store.categories');

    //Update Categories
    Route::get('/edit-category/{id}', [AdminsController::class, 'editCategories'])->name('edit.categories');
    Route::post('/edit-category/{id}', [AdminsController::class, 'updateCategories'])->name('update.categories');

    //Delete Categories
    Route::get('/delete-category/{id}', [AdminsController::class, 'deleteCategories'])->name('delete.categories');
});
