<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//home/beranda/index
Route::get('/', function () {
    return view('welcome');
});

//membuat route (url) ke halaman halo
Route::get("/halo", function () {
    return "Hallo semua";
});

Route::get("/mahasiswa/{nama}", function ($nama) {
    echo "<h2>Hallo semua</h2>";
    echo "Nama Saya $nama";
});
