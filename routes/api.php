<?php


use App\Http\Middleware\JWT;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResetPasswordController;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/sendEmail', [AuthController::class, 'sendEmail'])->name('sendEmail');

    Route::post('i_forgot_my_password', [ResetPasswordController::class, 'i_forgot_my_password'])->name('i_forgot_my_password');
    Route::post('reset_password', [ResetPasswordController::class, 'reset_password'])->name('reset_password');

    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register_user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh_token', [AuthController::class, 'refresh'])->name('refresh_token');
    Route::post('/me', [AuthController::class, 'me'])->name('me');
    ROute::post('/validate_token', [AuthController::class, 'validateToken'])->middleware([JWT::class])->name('validate_token');


    Route::prefix('users')->group(function () {
        Route::get('get_users', [UserController::class, 'getUsers'])->middleware([JWT::class]);
        Route::post('/register_user', [UserController::class, 'register'])->middleware([JWT::class])->name('register_user');
        Route::put('/update_user/{id}', [UserController::class, 'update'])->middleware([JWT::class])->name('update_user');
        Route::delete('/delete_user/{id}', [UserController::class, 'delete'])->middleware([JWT::class])->name('delete_user');
        Route::get('desactivate_user/{id}', [UserController::class, 'desactivateUser'])->middleware([JWT::class]);
        Route::get('activate_user/{id}', [UserController::class, 'activateUser'])->middleware([JWT::class]);
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('get_roles_home', [RolController::class, 'get_roles_home'])->middleware([JWT::class]);
        Route::get('get_roles', [RolController::class, 'getRoles'])->middleware([JWT::class]);
        Route::post('create_role', [RolController::class, 'createRole'])->middleware([JWT::class]);
        Route::put('update_role/{id}', [RolController::class, 'updateRole'])->middleware([JWT::class]);
        Route::delete('delete_role/{id}', [RolController::class, 'deleteRole'])->middleware([JWT::class]);
    });
});
