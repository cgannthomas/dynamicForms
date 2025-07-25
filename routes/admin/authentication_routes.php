<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;

Route::group(['as' => 'admin.', 'namespace' => 'Admin'], function () {


    /**
     * Admin Login screen
     *
     * GET /admin-login
     */
    Route::get('admin-login', [AdminAuthController::class, 'getLogin'])->name('login');

    /**
     * Login
     *
     * POST admin/login
     *
     * @param email : admin login email (string | required | email)
     * @param password : admin login password (string | required | min:5)
     *
     * @response 200 : return status (json)
     * @response 400 : bad request | validation error (json)
     * @response 404 : credentails mismatch (json)
     */
    Route::post('admin/login', [AdminAuthController::class, 'postLogin'])/*->middleware('guest:admin')*/->name('post-login');


});