<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LogsController;

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

//The following are for post control
Route::get('/posts/create',[
    PostController::class, 'create'
])->name('posts.create');

Route::get('/posts',[
    PostController::class,'index'
])->name('posts.index');

Route::get('/posts/{post}',[
    PostController::class,'show'
])->name('posts.show');

Route::post('/posts',[
    PostController::class, 'store'
]);

Route::get('/posts/{post}/edit',[
    PostController::class,'edit'
])->name('posts.edit');

Route::get('/posts/{post}/delete',[
    PostController::class, 'destroy'
]);

Route::put('/posts/{post}',[
    PostController::class, 'update'
])->name('posts.update');

//The following regard Emails
Route::get('/contact',[
    ContactController::class,'show'
]);

Route::post('/contact',[
    ContactController::class,'contact'
])->name('email.contact');

//The following are for user sign in
Route::get('/signin',[
    UserController::class, 'index'
])->name('user.sign');

Route::post('/signin',[
    UserController::class, 'signin'
])->name('user.signin');

Route::post('/signup',[
    UserController::class, 'signup'
])->name('user.signup');

Route::get('/signout',[
    UserController::class, 'signout'
])->name('user.signout');

Route::get('/p/{user}',[
    UserController::class, 'profile'
])->name('profile.show');

Route::get('/creators',[
    UserController::class, 'creators'
])->name('profile.index');

Route::post('/p/{user}/update',[
    UserController::class, 'update'
])->name('profile.update');

//The following are for log access
Route::get('/logs',[
    LogsController::class, 'index'
])->name('logs');