<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\MemberaccountsController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\SuperAdmin\IndexController;
use App\Http\Controllers\SuperAdmin\PermissionsController;
use App\Http\Controllers\SuperAdmin\RolesController;
use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/superadmin', function () {
//     return view('superadmins.index');
// })->middleware(['auth', 'verified', 'role:SuperAdmin'])->name('superadmin.index');

Route::middleware(['auth', 'verified', 'role:SuperAdmin'])->name('superadmin.')->prefix('superadmin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');

    Route::resource('/roles', RolesController::class);
    Route::post('/roles/{roleId}/permissions', [RolesController::class, 'grantPermission'])->where('roleId', '[0-9]+')->name('roles.grantPermission');
    Route::delete('/roles/{roleId}/permissions/{permissionId}', [RolesController::class, 'revokePermission'])->where(['roleId', '[0-9]+'], ['permissionId', '[0-9]+'])->name('roles.revokePermission');

    Route::resource('/permissions', PermissionsController::class);
    Route::post('/permissions/{permissionId}/roles', [PermissionsController::class, 'assignRole'])->where('permissionId', '[0-9]+')->name('permissions.assignRole');
    Route::delete('/permissions/{permissionId}/roles/{roleId}', [PermissionsController::class, 'removeRole'])->where(['permissionId', '[0-9]+'], ['roleId', '[0-9]+'])->name('permissions.removeRole');

    /**Users Roles & Permissions */
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UsersController::class, 'show'])->where('id', '[0-9]+')->name('users.show');

    Route::post('/users/{userId}/roles', [UsersController::class, 'assignRole'])->where('userId', '[0-9]+')->name('users.assignRole');
    Route::delete('/users/{userId}/roles/{roleId}', [UsersController::class, 'removeRole'])->where(['userId', '[0-9]+'], ['roleId', '[0-9]+'])->name('users.removeRole');

    Route::post('/users/{userId}/permissions', [UsersController::class, 'grantPermission'])->where('userId', '[0-9]+')->name('users.grantPermission');
    Route::delete('/users/{userId}/permissions/{permissionId}', [UsersController::class, 'revokePermission'])->where(['roleId', '[0-9]+'], ['permissionId', '[0-9]+'])->name('users.revokePermission');

    // Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    // Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    // Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->where('id', '[0-9]+')->name('users.edit');
    // Route::put('/users/{id}', [UsersController::class, 'update'])->where('id', '[0-9]+')->name('users.update');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->where('id', '[0-9]+')->name('users.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('/members')->group(function () {
    //List Members
    Route::get('/', [MembersController::class, 'index'])->name('member.index');
    Route::get('/create', [MembersController::class, 'create'])->name('member.create');
    Route::post('/', [MembersController::class, 'store'])->name('member.store');
    Route::get('/{id}', [MembersController::class, 'show'])->where('id', '[0-9]+')->name('member.show');
    Route::get('/memberAccounts/{id}', [MembersController::class, 'memberAccounts'])->where('id', '[0-9]+')->name('member.memberAccounts');
    Route::get('/{member_id?}/{account_id?}', [MembersController::class, 'memberAccountDetails'])/*->where([['member_id', '[0-9]+'], ['account_id', '[0-9]+']])*/->name('member.memberAccountDetails');
    Route::get('/{id}/edit', [MembersController::class, 'edit'])->name('member.edit');
    Route::put('/{id}', [MembersController::class, 'update'])->name('member.update');
    Route::delete('/{id}', [MembersController::class, 'destroy'])->name('member.destroy');
});

Route::prefix('/accounts')->group(function () {
    //List Accounts
    Route::get('/', [AccountsController::class, 'index'])->name('account.index');
    Route::get('/create', [AccountsController::class, 'create'])->name('account.create');
    Route::post('/', [AccountsController::class, 'store'])->name('account.store');
    Route::get('/{id}', [AccountsController::class, 'show'])->where('id', '[0-9]+')->name('account.show');
    Route::get('/{account_id?}/{member_id?}', [AccountsController::class, 'memberAccountDetails'])->name('account.memberAccountDetails');
    Route::get('/{id}/edit', [AccountsController::class, 'edit'])->where('id', '[0-9]+')->name('account.edit');
    Route::put('/{id}', [AccountsController::class, 'update'])->where('id', '[0-9]+')->name('account.update');
    Route::delete('/{id}', [AccountsController::class, 'destroy'])->where('id', '[0-9]+')->name('account.destroy');
});

// Route::prefix('/memberaccounts')->group(function () {
//     //List Memberaccounts
//     Route::get('/', [MemberaccountsController::class, 'index'])->name('memberaccount.index');
//     Route::get('/create', [MemberaccountsController::class, 'create'])->name('memberaccount.create');
//     Route::post('/', [MemberaccountsController::class, 'store'])->name('memberaccount.store');
//     Route::get('/{id}', [MemberaccountsController::class, 'show'])->name('memberaccount.show');
//     Route::get('/{id}/edit', [MemberaccountsController::class, 'edit'])->name('memberaccount.edit');
//     Route::put('/{id}', [MemberaccountsController::class, 'update'])->name('memberaccount.update');
//     Route::delete('/{id}', [MemberaccountsController::class, 'destroy'])->name('memberaccount.destroy');
// });

Route::prefix('/transactions')->group(function () {
    //List Transactions
    Route::get('/', [TransactionsController::class, 'index'])->name('transaction.index');
    Route::get('/create', [TransactionsController::class, 'create'])->name('transaction.create');
    Route::post('/', [TransactionsController::class, 'store'])->name('transaction.store');
    Route::get('/{id}', [TransactionsController::class, 'show'])->where('id', '[0-9]+')->name('transaction.show');
    Route::get('/{id}/edit', [TransactionsController::class, 'edit'])->where('id', '[0-9]+')->name('transaction.edit');
    Route::put('/{id}', [TransactionsController::class, 'update'])->where('id', '[0-9]+')->name('transaction.update');
    Route::delete('/{id}', [TransactionsController::class, 'destroy'])->where('id', '[0-9]+')->name('transaction.destroy');
});
