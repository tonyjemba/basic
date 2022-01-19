<?php

use App\Http\Controllers\about;
use App\Http\Controllers\aboutContoller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\seo_routeController;
use Illuminate\Support\Facades\Route;

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


Route::get('/about', [aboutContoller::class,'index']);

Route::get('/How_to_intall_devDependencies',[seo_routeController::class, 'index'])->name('blog1');

Route::get('/contact',[ContactController::class, 'index'])->middleware('age');