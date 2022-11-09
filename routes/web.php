<?php

use App\Http\Controllers\Api;
use App\Http\Controllers\Kontrol;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\New_;

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

Route::get('/', [Kontrol::class, 'index']);
Route::get('/api/{fungsi}', function ($fungsi) {
    $app = new Api();
    return $app->callAction($fungsi, $parameters = array("adi", "dudi"));
});
Route::post('/login', [Kontrol::class, 'authenticate']);
Route::post('/register', [Kontrol::class, 'daftar']);
Route::any('/redirectgoogle', [Kontrol::class, 'redirectToProvider']);
Route::any('/callbackgoogle', [Kontrol::class, 'handleProviderCallback']);




///////////////Tempatkan Paling terakhir/////////////////////
Route::any('/{halaman}', [Kontrol::class, 'halaman']);
// Untuk ngelink kaya storage di server yg ga support linking laravel
Route::get('/link/{link}', function ($link) {
    Artisan::call($link . ':link');
});

/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); */
