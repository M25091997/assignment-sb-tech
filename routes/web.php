<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\UserControler;
use App\Http\Controllers\ShortUrlRedirectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
    // return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // custom routes
    Route::get('/r/{code}', [ShortUrlRedirectController::class, 'redirect'])
        ->name('short-url.redirect');


    Route::get('invite/list', [UserControler::class, 'index'])->name('invite.index');
    Route::get('invite', [UserControler::class, 'create'])->name('invite.create');
    Route::post('invite', [UserControler::class, 'store'])->name('invite.store');

    // companies
    Route::resource('company', CompanyController::class);
    Route::resource('short-url', ShortUrlController::class);
});

// Publicly Resolvable
Route::get('/r/{code}', [ShortUrlRedirectController::class, 'publiclyRedirect'])
    ->name('short-url.public')->middleware('throttle:60,1');


require __DIR__ . '/auth.php';
