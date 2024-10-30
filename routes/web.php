<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{
    User\UserController as UserAdminController,
    Role\PermissionController as PermissionAdminController
}; 

use App\Http\Controllers\Site\{
    HomeController, 
    User\UserController as UserSiteController
};

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserSiteController::class, 'show'])->name('profile');
    Route::post('/profile/update-password', [UserSiteController::class, 'updatePassword'])->name('profile.updatePassword');
    
    Route::prefix('admin')->group(function() {
        Route::group(['middleware' => ['permission:view_users']], function() {
            Route::get('/users', [UserAdminController::class, 'index'])->name('admin.users.index');
        });

        Route::group(['middleware' => ['permission:create_users']], function() {
            Route::get('/users/create', [UserAdminController::class, 'create'])->name('admin.users.create');
            Route::post('/users', [UserAdminController::class, 'store'])->name('admin.users.store');
        });

        Route::group(['middleware' => ['permission:modify_users']], function() {
            Route::get('/users/{user}/edit', [UserAdminController::class, 'edit'])->name('admin.users.edit');
            Route::put('/users/{user}/edit', [UserAdminController::class, 'update'])->name('admin.users.update');
        });

        Route::group(['middleware' => ['permission:delete_users']], function() {
            Route::delete('/users/{user}', [UserAdminController::class, 'destroy'])->name('admin.users.destroy');
        });

        Route::group(['middleware' => ['permission:view_roles']], function() {
            Route::get('/roles', [PermissionAdminController::class, 'index'])->name('admin.roles.index');
        });

        Route::group(['middleware' => ['permission:create_roles']], function() {
            Route::get('/roles/create', [PermissionAdminController::class, 'create'])->name('admin.roles.create');
            Route::post('/roles', [PermissionAdminController::class, 'store'])->name('admin.roles.store');
        });

        Route::group(['middleware' => ['permission:modify_roles']], function() {
            Route::get('/roles/{role}/edit', [PermissionAdminController::class, 'edit'])->name('admin.roles.edit');
            Route::put('/roles/{role}/edit', [PermissionAdminController::class, 'update'])->name('admin.roles.update');
        });

        Route::group(['middleware' => ['permission:delete_roles']], function() {
            Route::delete('/roles/{role}', [PermissionAdminController::class, 'destroy'])->name('admin.roles.destroy');
        });
    });
});
