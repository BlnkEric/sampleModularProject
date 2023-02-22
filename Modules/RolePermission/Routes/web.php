<?php

use Modules\RolePermission\Http\Controllers\PermissionController;

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

Route::prefix('rolepermission')->group(function() {
    Route::get('/', 'RolePermissionController@index')->name('roleindex');
    Route::get('/roles', [PermissionController::class,'Permission']);
    Route::get('/test', [PermissionController::class,'test']);
});
