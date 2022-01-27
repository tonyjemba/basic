<?php

use App\Http\Controllers\aboutContoller;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\multipleImageController;
use App\Http\Controllers\seo_routeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\DB;


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


//welcom

Route::get('/', function () {
    return view('welcome');
});


Route::get('/about', [aboutContoller::class,'index']);

Route::get('/How_to_intall_devDependencies',[seo_routeController::class, 'index'])->name('blog1');

Route::get('/contact',[ContactController::class, 'index'])->middleware('age');

//category route

Route::get('/category/all',[categoryController::class, 'index'])->name('all.category');
Route::post('/category/add',[categoryController::class, 'addCat'])->name('store_category');
Route::get('/category/edit/{id}',[categoryController::class,'edit']);
Route::post('category/update/{id}', [categoryController::class,'update']);
Route::get('softdelete/category/{id}',[categoryController::class,'softdelete']);
Route::get('category/restore/{id}',[categoryController::class,'restore']);
Route::get('category/delete/permanent/{id}',[categoryController::class,'deletePermanent']);

//brands routes
Route::get('/brand/all',[BrandController::class,'index'])->name('all.brand');
Route::post('/brand/add',[BrandController::class,'addBrand'])->name('store_brand');
Route::get('/brand/edit/{id}',[BrandController::class,'edit']);
Route::post('/brand/update/{id}',[BrandController::class,'update']);
Route::get('/brand/delete/{id}',[BrandController::class,'delete']);

//multiple Images routes
Route::get('multipleImages/all',[multipleImageController::class,'index'])->name('multipleImage');
Route::post('multipleImages/add',[multipleImageController::class,'add'])->name('addmultipleImages');
//middleware
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    //using eloquent ORM
    $users = User::all();
    //  using query builder
    // $users = DB::table('users')->get();
    
    return view('dashboard',compact('users'));
})->name('dashboard');
