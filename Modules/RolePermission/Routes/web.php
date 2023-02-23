<?php

use Modules\RolePermission\Http\Controllers\Backend\PermissionController;

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

Route::group(['namespace' => '\Modules\RolePermission\Http\Controllers\Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth'], 'prefix' => 'admin'], function () {
    /*
    * These routes need view-backend permission
    * (good if you want to allow more than one group in the backend,
    * then limit the backend features by different roles or permissions)
    *
    * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
    */

    /*
     *
     *  Posts Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'RolePermission';
    $controller_name = 'RoleController';
    Route::resource("$module_name", "$controller_name");

    /*
     *
     *  Categories Routes
     *
     * ---------------------------------------------------------------------
     */
    // $module_name = 'categories';
    // $controller_name = 'CategoriesController';
    // Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    // Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    // Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    // Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    // Route::resource("$module_name", "$controller_name");
});







// Route::group(['namespace' => 'App\Http\Controllers\Frontend', 'as' => 'frontend.'], function () {
//     Route::get('/', 'FrontendController@index')->name('index');
//     Route::get('home', 'FrontendController@index')->name('home');
//     Route::get('privacy', 'FrontendController@privacy')->name('privacy');
//     Route::get('terms', 'FrontendController@terms')->name('terms');

//     Route::group(['middleware' => ['auth']], function () {
//         /*
//         *
//         *  Users Routes
//         *
//         * ---------------------------------------------------------------------
//         */
//         $module_name = 'users';
//         $controller_name = 'UserController';
//         Route::get('profile/{id}', ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
//         Route::get('profile/{id}/edit', ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
//         Route::patch('profile/{id}/edit', ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
//         Route::get('profile/changePassword/{username}', ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
//         Route::patch('profile/changePassword/{username}', ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
//         Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
//         Route::delete("$module_name/userProviderDestroy", ['as' => "$module_name.userProviderDestroy", 'uses' => "$controller_name@userProviderDestroy"]);
//     });
// });
