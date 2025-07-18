<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Livewire\List\Index as indexBuy;
use App\Livewire\User\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\Users\Index;

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::middleware(['auth'])->group(function () {
    Route::get('/users', Index::class)->name('users.index');

    Route::get('/user/profile', Profile::class)->name('user.profile');

    Route::get('/list', indexBuy::class)->name('list.index');
});

require __DIR__.'/auth.php';
