<?php
use App\Http\Controllers\Authcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\Auth\GoogleAuthController;

Route::post('/register/student',[StudentRegisterController::class , 'register']);
Route::post('/auth/google',[GoogleAuthController::class , 'redirect']);