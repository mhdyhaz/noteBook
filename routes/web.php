<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;

Route::get('/Dashborde',[HomeController::class,'home'])->name('Dashborde.home');
Route::get('/Layouts',[HomeController::class,'app'])->name('Layouts.app');

Route::get('/Dashborde/login', [LoginController::class, 'showLoginForm'])->name('Dashborde.login');
Route::post('/Dashborde/login', [LoginController::class, 'login']);

Route::get('/Dashborde/register', [RegisterController::class, 'showRegistrationForm'])->name('Dashborde.register');
Route::post('/Dashborde/register', [RegisterController::class, 'register']);

Route::get('/AllMenus/menu', [MenuController::class, 'index'])->middleware(\App\Http\Middleware\Authenticate::class)->name('AllMenus.menu');

Route::get('/AllMenus/creatMenu',[MenuController::class,'create'])->name('AllMenus.createMenu');
Route::post('/AllMenus/creatMenu', [MenuController::class, 'store'])->name('AllMenus.createMenu');
Route::get('/AllMenus/edit',[MenuController::class,'edit'])->name('AllMenus.edit');
Route::get('/AllMenus/menu', [MenuController::class, 'index'])->name('AllMenus.menu');




Route::post('/Tag/addTag', [TagController::class, 'store'])->name('Tag.addTag');
Route::get('/Tag/addTag', [TagController::class, 'index'])->name('Tag.addTag');




Route::get('/Share/sharedMe', [UserController::class, 'sharedMe'])->name('Share.sharedMe');
Route::get('/Share/sharedOther', [UserController::class, 'sharedOther'])->name('Share.sharedOther');
Route::post('/Share/shareMenu', [UserController::class, 'shareMenu'])->name('menu.share');
