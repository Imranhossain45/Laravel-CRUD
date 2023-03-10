<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('category', CategoryController::class);
Route::resource('post', PostController::class);
Route::get('post/status/{post}', [PostController::class,'postStatus'])->name('post.status');
Route::get('post/restore/{id}', [PostController::class,'postRestore'])->name('post.restore');
Route::delete('post/forcedelete/{id}', [PostController::class, 'postForceDelete'])->name('post.force.delete');