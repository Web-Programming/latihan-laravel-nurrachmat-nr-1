<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //halaman login
    public function index() {
        //ambil data use simpan di variable $user
        $user = Auth::user();

        //jika ada user (user telah logged in)
        if($user){
            //jika user memiliki level admin
            if($user->level == 'admin'){
                return redirect()->intended('admin');
            }
            //jika user memiliki level user
            else if($user->level == 'user'){
                return redirect()->intended('user');
            }
        }

        return view('login');
    }

    public function proses_login(Request $request){
        //form validation
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );
        //ambil data dari $request, username dan password saja
        $credential = $request->only('email', 'password');
        //proses cek login di tabel users
        if(Auth::attempt($credential)){
            //jika login berhasil
            $user = Auth::user();
            if($user->level == 'admin'){
                return redirect()->intended('admin');
            }else if($user->level == 'user'){
                return redirect()->intended('user');
            }
            return redirect()->intended('/');
        }

        //jika login gagal, arahkan ke halaman login
        //gunakan flash data untuk menampilkan error
        return redirect('login')
            ->withInput()
            ->withErrors(
                ['login_gagal' => 'User tidak terdaftar (email atau password salah)!']
            );
    }

    public function logout(Request $request){
        //menghapus session login
        $request->session()->flush();
        Auth::logout();
        return redirect('login');
    }

    public function register(){
        return view('register');
    }

    public function proses_register(Request $request){
        // buat validasi untuk proses register
        // validasi semua field wajib di isi
        // validasi email harus unique atau tidak boleh duplicate

        $validator =  Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);

        // jika gagal kembali ke halaman register dengan munculkan pesan error
        if($validator ->fails()){
            return redirect('/register')
             ->withErrors($validator)
             ->withInput();
        }
        // jika berhasil isi level & hash password agar secure
        $request['level'] = 'user';
        $request['password'] = Hash::make($request->password);

        // masukkan semua data pada request ke table user
        User::create($request->all());

        // jika berhasil arahkan ke halaman login
        return redirect()->route('login');
    }
}
