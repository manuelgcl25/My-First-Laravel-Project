<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Services\MailchimpNewsletter;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;



Route::get('/', [PostController::class, 'index'])->name('home');


Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::post('newsletter', NewsletterController::class); // as this is gonna be a single-action controller we dont need to give it an action name like the rest (e.g. 'index', 'create',etc.).
// when that happens (single action) we just give it a ::class path and then use __invoke method within the controller

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

//Admin
Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('can:admin');
Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('can:admin');
Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('can:admin');
Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('can:admin');
Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('can:admin');
Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('can:admin');
