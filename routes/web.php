<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;


Route::get('/Dashborde', [HomeController::class, 'home'])->name('Dashborde.home');
Route::get('/Layouts', [HomeController::class, 'app'])->name('Layouts.app');

Route::get('/Dashborde/login', [LoginController::class, 'showLoginForm'])->name('Dashborde.login');
Route::post('/Dashborde/login', [LoginController::class, 'login']);

Route::get('/Dashborde/register', [RegisterController::class, 'showRegistrationForm'])->name('Dashborde.register');
Route::post('/Dashborde/register', [RegisterController::class, 'register']);


Route::middleware(['auth'])->group(function () {
    Route::get('/AllMenus/menu', [MenuController::class, 'index'])->name('AllMenus.menu');
    Route::get('/AllMenus/createMenu', [MenuController::class, 'create'])->name('AllMenus.createMenu');
    Route::post('/AllMenus/createMenu', [MenuController::class, 'store'])->name('AllMenus.store');
    Route::get('/AllMenus/list', [MenuController::class, 'list'])->name('AllMenus.list');

    Route::get('/AllMenus/edit/{id}', [MenuController::class, 'editMenu'])->name('AllMenus.editMenu');
    Route::put('/AllMenus/edit/{id}', [MenuController::class, 'update'])->name('AllMenus.update');
    Route::delete('/AllMenus/list/{id}', [MenuController::class, 'destroy'])->name('AllMenus.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::post('/Tag/addTag', [TagController::class, 'store'])->name('Tag.addTag');
    Route::get('/Tag/addTag', [TagController::class, 'index'])->name('Tag.addTag');
});


Route::middleware(['auth'])->group(function () {
    Route::delete('/Share/sharedOther', [UserController::class, 'removeSharedMenuAsSender'])->name('shared-menu.remove-as-sender');
 
    
    Route::post('/Share/shareMenu', [UserController::class, 'shareMenu'])->name('Share.shareMenu');
    Route::post('/check-email', [UserController::class, 'checkEmail']);
    Route::get('/Share/sharedOther', [UserController::class, 'sharedOther'])->name('Share.sharedOther');
    Route::post('/Share/removeShared', [UserController::class, 'removeSharedMenu'])->name('Share.removeShared');
    Route::get('/Share/sharedMe', [UserController::class, 'receivedSharedMenus'])->name('Share.sharedMe');
});
