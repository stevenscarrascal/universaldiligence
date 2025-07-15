<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\SourcesController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function(){
    Route::get('/countries/{id}/{name}',[CountriesController::class,'show'])->name('countries.show');
    Route::get('/sources/{id}/{name}/create',[SourcesController::class,'create'])->name('sources.create');
    Route::get('/sources/{id}/{name}/edit',[SourcesController::class,'edit'])->name('sources.edit');
});
