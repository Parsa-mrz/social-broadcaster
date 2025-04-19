<?php

use App\Livewire\Checkout;
use App\Livewire\Login;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/',Login::class);

Route::get ('login',Login::class)->name('login');
Route::get ('register',Register::class)->name('register');
Route::get ('checkout',Checkout::class)->name('checkout');
