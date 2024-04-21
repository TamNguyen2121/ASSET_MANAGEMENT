<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.home');
});
Route::get('/login', App\Livewire\Auth\Login::class)->name('auth.login');
Route::prefix('admin')->middleware(['checkLogin'])->group(function () {
    // DASHBROAD
    Route::get('', App\Livewire\Admin\Index::class)->name('admin.home');
    // USER
    Route::get('user', App\Livewire\Employee\Index::class)->name('admin.employee.list');
    Route::get('user/create', App\Livewire\Employee\Create::class)->name('admin.employee.create');
    Route::get('user/edit/{id}', App\Livewire\Employee\Edit::class)->name('admin.employee.edit');
    // SUPLIER
    Route::get('suplier', App\Livewire\Suplier\Index::class)->name('admin.suplier.list');
    Route::get('suplier/create', App\Livewire\Suplier\Create::class)->name('admin.suplier.create');
    Route::get('suplier/edit/{id}', App\Livewire\Suplier\Edit::class)->name('admin.suplier.edit');
    // EQUIPMENT TYPE
    Route::get('asset-type', App\Livewire\AssetType\Index::class)->name('admin.asset_type.list');
    Route::get('asset-type/create', App\Livewire\AssetType\Create::class)->name('admin.asset_type.create');
    Route::get('asset-type/edit/{id}', App\Livewire\AssetType\Edit::class)->name('admin.asset_type.edit');
    // EQUIPMENT
    Route::get('asset', App\Livewire\Asset\Index::class)->name('admin.asset.list');
    Route::get('asset/create', App\Livewire\Asset\Create::class)->name('admin.asset.create');
    Route::get('asset/edit/{id}', App\Livewire\Asset\Edit::class)->name('admin.asset.edit');
    // ALLOCATION
    Route::get('allocation', App\Livewire\Allocation\Index::class)->name('admin.allocation.list');
    Route::get('allocation/issued', App\Livewire\Allocation\Index1::class)->name('admin.allocation.issued');
    Route::get('allocation/history', App\Livewire\Allocation\History::class)->name('admin.allocation.history');
    Route::get('allocation/create/{id}', App\Livewire\Allocation\Create::class)->name('admin.allocation.create');
    Route::get('allocation/edit/{id}', App\Livewire\Allocation\Edit::class)->name('admin.allocation.edit');
    Route::get('allocation/view/{id}', App\Livewire\Allocation\View::class)->name('admin.allocation.view');
    Route::get('allocation/view-history/{id}', App\Livewire\Allocation\ViewHistory::class)->name('admin.allocation.viewHistory');

    // LOGOUT
    Route::get('log-out', [App\Http\Controllers\Auth\Logout::class, 'logOut'])->name('auth.logout');
});
