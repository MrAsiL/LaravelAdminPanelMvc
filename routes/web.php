<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminYonetimController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/yonetim/moduller', function () {
    return view('admin.include.moduller');
});
Route::middleware(['auth:sanctum', 'verified'])->prefix('yonetim')->group(function (){

    Route::get('/',[AdminYonetimController::class,'home'])->name('home');
    Route::get('/moduller',[\App\Http\Controllers\ModulController::class,'index'])->name('moduller');
    Route::post('/modul-ekle',[\App\Http\Controllers\ModulController::class,'modulekle'])->name('modul-ekle');
    Route::get('/liste/{modul}',[\App\Http\Controllers\AdminYonetimController::class,'liste'])->name('liste');
    Route::get('/ekle/{modul}',[\App\Http\Controllers\AdminYonetimController::class,'ekle'])->name('ekle');
    Route::post('/ekle-post/{modul}',[\App\Http\Controllers\AdminYonetimController::class,'eklePost'])->name('eklepost');
    Route::get('/duzenle/{modul}/{id}',[\App\Http\Controllers\AdminYonetimController::class,'duzenle'])->name('duzenle');
    Route::post('/duzenle-post/{modul}/{id}',[\App\Http\Controllers\AdminYonetimController::class,'duzenlePost'])->name('duzenlepost');
    Route::get('/sil/{modul}/{id}',[\App\Http\Controllers\AdminYonetimController::class,'sil'])->name('sil');
    Route::get('/durum/{modul}/{id}',[\App\Http\Controllers\AdminYonetimController::class,'durum'])->name('durum');
    Route::get('/ayarlar',[\App\Http\Controllers\AdminYonetimController::class,'ayarlar'])->name('ayarlar');
    Route::post('/ayarpost',[\App\Http\Controllers\AdminYonetimController::class,'ayarpost'])->name('ayarpost');


});
