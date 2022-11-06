<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\MemberaccountsController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\SuperAdmin\IndexController;
use App\Http\Controllers\SuperAdmin\PermissionsController;
use App\Http\Controllers\SuperAdmin\RolesController;
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
    Route::delete('/roles/{roelId}/permissions/{permissionId}', [RolesController::class, 'revokePermission'])->where(['roleId', '[0-9]+'], ['permissionId', '[0-9]+'])->name('roles.revokePermission');

    Route::resource('/permissions', PermissionsController::class);
    Route::post('/permissions/{permissionId}/roles', [PermissionsController::class, 'assignRole'])->where('roleId', '[0-9]+')->name('permissions.assignRole');
    Route::delete('/permissions/{permissionId}/roles/{roelId}', [PermissionsController::class, 'removeRole'])->where(['permissionId', '[0-9]+'], ['roleId', '[0-9]+'])->name('permissions.removePermission');
});

require __DIR__ . '/auth.php';

Route::prefix('/members')->group(function () {
    //List Members
    Route::get('/', [MembersController::class, 'index'])->name('member.index');
    Route::get('/create', [MembersController::class, 'create'])->name('member.create');
    Route::post('/', [MembersController::class, 'store'])->name('member.store');
    Route::get('/{id}', [MembersController::class, 'show'])->where('id', '[0-9]+')->name('member.show');
    Route::get('/memberAccounts/{id}', [MembersController::class, 'memberAccounts'])->where('id', '[0-9]+')->name('member.memberAccounts');
    Route::get('/{id}/edit', [MembersController::class, 'edit'])->name('member.edit');
    Route::put('/{id}', [MembersController::class, 'update'])->name('member.update');
    Route::delete('/{id}', [MembersController::class, 'destroy'])->name('member.destroy');
});

Route::prefix('/accounts')->group(function () {
    //List Accounts
    Route::get('/', [AccountsController::class, 'index'])->name('account.index');
    Route::get('/create', [AccountsController::class, 'create'])->name('account.create');
    Route::post('/', [AccountsController::class, 'store'])->name('account.store');
    Route::get('/{id}', [AccountsController::class, 'show'])->name('account.show');
    Route::get('/{id}/edit', [AccountsController::class, 'edit'])->name('account.edit');
    Route::put('/{id}', [AccountsController::class, 'update'])->name('account.update');
    Route::delete('/{id}', [AccountsController::class, 'destroy'])->name('account.destroy');
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
    Route::get('/{id}', [TransactionsController::class, 'show'])->name('transaction.show');
    Route::get('/{id}/edit', [TransactionsController::class, 'edit'])->name('transaction.edit');
    Route::put('/{id}', [TransactionsController::class, 'update'])->name('transaction.update');
    Route::delete('/{id}', [TransactionsController::class, 'destroy'])->name('transaction.destroy');
});
