<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /**
     * Halaman awal untuk admin
     */
    public function index(){
        return view('admin.index');
    }

    /**
     * Halaman login untuk admin
     */
    public function login(){
        return view('admin.login');
    }

    /**
     * Halaman Registrasi untuk admin
     */
    public function register(){
        return view('admin.register');
    }

    /**
     * Halaman untuk menampilkan data pesanan
     */
    public function pesanan(){
        return view('admin.pesanan');
    }

    /**
     * Daftar sebagai admin
     * @param  \Illuminate\Http\Request  $request
     */
    public function registerAsAdmin(Request $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('auth.login');
    }

    /**
     * login sebagai admin
     * @param  \Illuminate\Http\Request  $request
     */
    public function loginAsAdmin(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            return redirect()->route('admin.pesanan');
        }

        Alert::error('Gagal', 'Email atau password salah');
    }
}