<?php

use App\Http\Livewire\Auth\RabbitCreate;
use App\Http\Livewire\Auth\RabbitEdit;
use App\Http\Livewire\Auth\Rabbits;
use App\Http\Livewire\Auth\Breeding;
use App\Http\Livewire\Auth\BreedingCreate;
use App\Http\Livewire\GlobalSettings;
use App\Http\Livewire\PermissionEdit;
use App\Http\Livewire\RoleCreate;
use App\Http\Livewire\RoleEdit;
use App\Http\Livewire\Roles;
use App\Http\Livewire\UserCreate;
use App\Http\Livewire\UserEdit;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', fn() => view('dashboard'))->name('dashboard');
    });

    Route::prefix('rabbits')->group(function () {
        Route::get('/', Rabbits::class)->name('rabbits');
        Route::get('/create', RabbitCreate::class)->name('rabbit.create');
        Route::get('/edit/{rabbit}', RabbitEdit::class)->name('rabbit.edit');
    });

    Route::prefix('breeding')->group(function () {
        Route::get('/', Breeding::class)->name('breeding');
        Route::get('/breeding-create', BreedingCreate::class)->name('breeding.create');
    });

    Route::prefix('manage-users')->group(function () {
        Route::get('/users', fn() => view('users'))->name('users');
        Route::get('/user/edit/{user}', UserEdit::class)->name('user.edit');
        Route::get('/user/create', UserCreate::class)->name('user.create');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', Roles::class)->name('roles');
        Route::get('/edit/{role}', RoleEdit::class)->name('role.edit');
        Route::get('/create', RoleCreate::class)->name('role.create');
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/edit/{role}', PermissionEdit::class)->name('permission.edit');
    });

    Route::prefix('global-settings')->group(function () {
        Route::get('/', GlobalSettings::class)->name('global-settings');
    });

    Route::get('storage/{path}',
        function ($path) {
            $real_path = decrypt($path);

            return Image::make(storage_path("app/$real_path"))->response();
        })->name('storage.view');

    Route::get('storage/video/{path}',
        function ($path) {
            $real_path = storage_path('app/'.decrypt($path));

            if (!File::exists($real_path)) {
                abort(404);
            }
            $stream = new \App\Feature\VideoStream("$real_path");

            return response()->stream(function () use ($stream) {
                $stream->start();
            });
        })->name('storage.video');
});
