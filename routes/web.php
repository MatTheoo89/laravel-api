<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [PageController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class);
});

    require __DIR__.'/auth.php';
    
    Route::get('{any?}', function(){
        return view('guest.home');
    })->where('any', '.*')->name('home');