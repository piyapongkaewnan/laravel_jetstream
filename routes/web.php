<?php

use App\Models\Post;
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
// Route::middleware(['auth'])->get('/', function () {
//     return view('welcome');
// })->name('home');


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/posts', function () {
        return view('posts' , ['posts' => Post::paginate(5)]);
    })->name('posts');

    Route::get('/orders', function () {
        return view('orders');
    })->name('orders');

    Route::get('/projects', function () {
        return view('projects');
    })->name('projects');


});
