<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Form\FormController;
use App\Http\Controllers\Admin\User\UserSubmittedDataController;

Route::group(['as' => 'admin.', 'middleware' => 'auth_admin', 'prefix' => 'admin'], function () {

    Route::get('dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');

    Route::resource('forms', FormController::class);

    Route::resource('users', UserSubmittedDataController::class);

    Route::any('logout', [AdminController::class, 'adminLogout'])->name('logout');



});