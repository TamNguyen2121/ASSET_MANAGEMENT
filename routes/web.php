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
    return view('welcome');
});
Route::get('/login', App\Livewire\Auth\Login::class)->name('auth.login');
Route::prefix('admin')->middleware(['checkLogin'])->group(function () {
    // DASHBROAD
    Route::get('', App\Livewire\Admin\Index::class)->name('admin.home');
    // USER
    Route::get('user', App\Livewire\User\Index::class)->name('admin.user.list');
    Route::get('user/create', App\Livewire\User\Create::class)->name('admin.user.create');
    Route::get('user/edit/{id}', App\Livewire\User\Edit::class)->name('admin.user.edit');
    // SUPLIER
    Route::get('supliers', App\Livewire\Supliers\Index::class)->name('admin.suplier.list');
    Route::get('supliers/create', App\Livewire\Supliers\Create::class)->name('admin.suplier.create');
    Route::get('supliers/edit/{id}', App\Livewire\Supliers\Edit::class)->name('admin.suplier.edit');
    // EQUIPMENT TYPE
    Route::get('equipment-type', App\Livewire\EquipmentType\Index::class)->name('admin.equipment_type.list');
    Route::get('equipment-type/create', App\Livewire\EquipmentType\Create::class)->name('admin.equipment_type.create');
    Route::get('equipment-type/edit/{id}', App\Livewire\EquipmentType\Edit::class)->name('admin.equipment_type.edit');
    // EQUIPMENT
    Route::get('equipment', App\Livewire\Equipment\Index::class)->name('admin.equipment.list');
    Route::get('equipment/create', App\Livewire\Equipment\Create::class)->name('admin.equipment.create');
    Route::get('equipment/edit/{id}', App\Livewire\Equipment\Edit::class)->name('admin.equipment.edit');
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
