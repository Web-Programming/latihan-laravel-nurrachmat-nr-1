<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\UserController;
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

/*Route::get("/mahasiswa/{nama}", function ($nama) {
    echo "<h2>Hallo semua</h2>";
    echo "Nama Saya $nama";
});*/

//route ke halaman fakultas index
Route::get("/fakultas/index", function() {
    //return view('fakultas.index', ['fikr' => 'Fakultas Ilmu Komputer dan Rekayasa']);
    $data = ['fakultas' => ['Fakultas Ilmu Komputer dan Rekayasa', 'Fakultas Ekonomi dan Bisnis']];
    return view('fakultas.index', $data);
});

//route ke controller dan halaman dosen
Route::resource('dosen', DosenController::class);


//raw query mahasiswa
Route::get('/mahasiswa/insert', [MahasiswaController::class, 'insert']);
Route::get('/mahasiswa/update', [MahasiswaController::class, 'update2']);
Route::get('/mahasiswa/delete', [MahasiswaController::class, 'delete']);
Route::get('/mahasiswa/select', [MahasiswaController::class, 'select']);

Route::get('/mahasiswa/index', [MahasiswaController::class, 'index']);

//query builder mahasiswa
Route::get('/mahasiswa/insertQb', [MahasiswaController::class, 'insertQb']);
Route::get('/mahasiswa/updateQb', [MahasiswaController::class, 'updateQb']);
Route::get('/mahasiswa/deleteQb', [MahasiswaController::class, 'deleteQb']);
Route::get('/mahasiswa/selectQb', [MahasiswaController::class, 'selectQb']);

//Eloquent ORM mahasiswa
Route::get('/mahasiswa/insertElq', [MahasiswaController::class, 'insertElq']);
Route::get('/mahasiswa/updateElq', [MahasiswaController::class, 'updateElq']);
Route::get('/mahasiswa/deleteElq', [MahasiswaController::class, 'deleteElq']);
Route::get('/mahasiswa/selectElq', [MahasiswaController::class, 'selectElq']);

Route::get('/mahasiswa/massinsert', [MahasiswaController::class, 'store']);

Route::get("/prodi/create", [ProdiController::class, 'create'])
    ->name("prodi.create");
Route::post("prodi/store", [ProdiController::class, "store"])
    ->name("prodi.store");
Route::get("/prodi/index", [ProdiController::class, 'index'])
    ->name("prodi.index");
Route::get("/prodi/{id}", [ProdiController::class, 'show'])
    ->name("prodi.show");
Route::get('/prodi/{prodi}/edit', [ProdiController::class, 'edit'])
    ->name('prodi.edit');
Route::patch('/prodi/{prodi}', [ProdiController::class, 'update'])
    ->name('prodi.update');
Route::delete('/prodi/{prodi}', [ProdiController::class, 'destroy'])
    ->name('prodi.destroy');


//CUSTOM AUTHENTICATION
Route::get("register", [AuthController::class, 'register'])->name("register");
Route::get("login", [AuthController::class, 'index'])->name("login");

Route::post("proses_register", [AuthController::class, 'proses_register'])->name("proses_register");
Route::post("proses_login", [AuthController::class, 'proses_login'])->name("proses_login");

Route::get("logout", [AuthController::class, 'logout'])->name("logout");

// atur menggunakan group middleware pada routing
// didalamnya terdapat group untuk mengecek kondisi login
// jika user yang login merupakan admin maka akan diarahkan ke AdminController
// jika user yang login merupakan user biasa maka akan diarahkan ke UserController
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::resource('admin', AdminController::class);
    });
    Route::group(['middleware' => ['cek_login:user']], function () {
        Route::resource('user', UserController::class);
    });
});
