<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RegionsController;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::resource('/teams', TeamsController::class);
    Route::resource('/users', UsersController::class);
    Route::resource('/departments', DepartmentsController::class);
    Route::resource('/regions', RegionsController::class);

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/pin-reconciliation', [GeneralController::class, 'user_rec'])->name('pin.recon');
    Route::get('/change-password/{id}', [UsersController::class, 'changepasscode'])->name('changepass');
    Route::any('/change-password/{id}', [UsersController::class, 'storepasscode'])->name('changepassword');

    Route::group(['prefix' => 'members', 'middleware' => ['role:admin,hod,team-leader,regional-head']], function(){
        Route::get('/team-members', [GeneralController::class, 'team_m'])->name('team.members')->middleware('role:admin,team-leader');
        Route::get('/department-members', [GeneralController::class, 'dept_m'])->name('department.members')->middleware('role:admin,hod');
        Route::get('/region-members', [GeneralController::class, 'region_m'])->name('region.members')->middleware('role:admin,regional-head');
    });

    Route::group(['prefix' => 'pin'], function(){
        Route::get('/new-pins', [GeneralController::class, 'newPin'])->name('npin');
        Route::get('/existing-pins', [GeneralController::class, 'existPin'])->name('epin');
    });

    Route::group(['prefix' => 'aum'], function(){
        Route::get('/new-aums', [GeneralController::class, 'newAum'])->name('naum');
        Route::get('/existing-aums', [GeneralController::class, 'existAum'])->name('eaum');
    });

    Route::get('/pin_create', [GeneralController::class, 'user_create'])->name('pfa.create')->middleware('role:admin,hod');
    Route::post('/pin_create', [GeneralController::class, 'user_store'])->name('pfa.store')->middleware('role:admin,hod');
});
