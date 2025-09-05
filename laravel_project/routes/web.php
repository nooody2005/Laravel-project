<?php

use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\Auth\AuthController;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

use App\Middleware\IsLogin;
use App\Middleware\NoCache;
use App\Http\Kernel;


Route::middleware(['auth', 'noCache'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::controller(AuthController::class)->group(function(){

    Route::get('/login','login')->name('login');
    Route::get('/register','register')->name('register');
    Route::get('/logout','logout')->name('logout');
    Route::post('handlelogin','handleLogin')->name('handleLogin');
    Route::post('handleRegister','handleRegister')->name('handleRegister');

});


Route::post('/subscribe-department/{department}', [DepartmentController::class, 'subscribe'])
    ->middleware('auth') // لازم يكون مسجل دخول
    ->name('departments.subscribe');

Route::post('/change-department/{department}', [DepartmentController::class, 'changeDepartment'])
    ->middleware('auth')
    ->name('departments.change');

    Route::post('/cancel-change', [DepartmentController::class, 'cancelChange'])->name('departments.cancelChange');



Route::get('/', function () {
    return view('welcome');
});



Route::middleware('isLogin')->prefix('/admin')->name('admin.')->group(function(){

    Route::get('/',HomeController::class)->name('home');
    

    Route::controller(StudentController::class)->name('students.')->group(function(){

        Route::get('/students','index')->name('index');
        Route::get('/students/create','create')->name('create');
        Route::get('/students/show/{id}','show')->where(['id'=>'[0-9]+'])->name('show');
        Route::post('/students','store')->name('store');
        Route::delete('/students/{id}','destroy')->name('destroy');
        Route::get('/students/{id}/edit','edit')->where(['id'=>'[0-9]+'])->name('edit');
        Route::put('/students/{id}','update')->where(['id'=>'[0-9]+'])->name('update');

    });



      Route::controller(DepartmentController::class)->name('departments.')->group(function(){

        Route::get('/departments','index_depart')->name('index_depart');
        Route::get('/departments/add_depart','add_depart')->name('add_depart');
        Route::post('/departments','store_depart')->name('store_depart');
        Route::delete('/departments/{id}','destroy_depart')->name('destroy_depart');
        Route::get('/departments/{id}/edit_depart','edit_depart')->name('edit_depart');
        Route::put('/departments/{id}','update_depart')->name('update_depart');
        

    });
});


