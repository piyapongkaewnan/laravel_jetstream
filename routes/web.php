<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
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


// Route::middleware(['auth'])->get('/', function () {
//     return view('welcome');
// })->name('home');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::prefix('auth')->group(function () {
        Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('auth.provider');
        Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('auth.provider.callback');
    });

    // // Google
    // Route::get('/auth/google', [LoginController::class, 'google']);
    // Route::get('/auth/google/redirect', [LoginController::class, 'googleRedirect']);

    // // Facebook
    // Route::get('/auth/facebook', [LoginController::class, 'facebook']);
    // Route::get('/auth/facebook/redirect', [LoginController::class, 'facebookRedirect']);

    // // Github
    // Route::get('/auth/github', [LoginController::class, 'github']);
    // Route::get('/auth/github/redirect', [LoginController::class, 'githubRedirect']);
});


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/posts', [PostController::class, 'index'])->name('posts');

    Route::get('/orders', function () {
        return view('orders');
    })->name('orders');

    Route::get('/projects', function () {
        return view('projects');
    })->name('projects');
});
