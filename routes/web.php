<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\MainPageController;

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

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {

        // Page Admin
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('/main', [MainController::class, 'index']);
        // Matches The "/admin/main" URL

        // Menu
        Route::prefix('/menu')->group(function () {
            Route::get('/add', [MenuController::class, 'create']);
            Route::post('/add', [MenuController::class, 'store']);
            Route::get('/list', [MenuController::class, 'index']);

            // Update, Delete and show List by Models
            // Route::get('/list/{id}', [MenuModelController::class, 'show']);
            // Route::get('/list/edit/{id}', [MenuModelController::class, 'edit']);
            // Route::patch('/update/{id}', [MenuModelController::class, 'update']);
            // Route::delete('/list/delete/{id}', [MenuModelController::class, 'destroy']);

            //Update and Delete by Services
            Route::DELETE('/list/destroy', [MenuController::class, 'delete']);
            Route::get('/list/edit/{menu}', [MenuController::class, 'show']);
            Route::post('/list/edit/{menu}', [MenuController::class, 'update']);
        });

        // Product
        Route::prefix('/product')->group(function () {
            Route::get('/add', [ProductController::class, 'create']);
            Route::post('/add', [ProductController::class, 'store']);
            Route::get('/list', [ProductController::class, 'index']);
        });

        // Upload
        Route::post('/upload/services', [UploadController::class, 'store']);

        //Slider
        Route::prefix('/slider')->group(function () {
            Route::get('/add', [SliderController::class, 'create']);
            Route::post('/add', [SliderController::class, 'store']);
            Route::get('/list', [SliderController::class, 'index']);
        });
    });
});

Route::get('/', [MainPageController::class, 'index']);
