<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontEnd\DashboardController;
use App\Http\Controllers\FrontEnd\FormSubmissionController;

//////////////////
// Admin Routes //
//////////////////

include_once 'admin/authentication_routes.php';
include_once 'admin/admin_user_routes.php';

///////////////////////////////////////


Route::get('/', [DashboardController::class, 'viewDashboard'])->name('dashboard');
Route::get('/form/{id}', [FormSubmissionController::class, 'viewForm'])->name('form.view');
Route::post('/form/{id}', [FormSubmissionController::class, 'submitForm'])->name('form.submit')->middleware('web');