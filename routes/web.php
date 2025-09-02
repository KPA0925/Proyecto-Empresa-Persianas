<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified','role:user'])->name('dashboard');

Route::get('admin', function () {
    return Inertia::render('Admin');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
