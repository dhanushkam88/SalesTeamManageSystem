<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;

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
    return redirect('/login');
})->name('home');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.admin-dashboard');
    })->name('dashboard');

    /** Admin routes **/
    Route::prefix('admin')->group(function () {
        Route::resource('dashboard', DashboardController::class);
            Route::middleware(['role:admin|manager'])->group(function(){
                Route::get('import-view', [AdminController::class, 'importView'])->name('import-view');
                Route::post('import-doc', [AdminController::class, 'importDoc'])->name('import-doc');
                Route::resource('user', AdminController::class);
            });

    });
});
