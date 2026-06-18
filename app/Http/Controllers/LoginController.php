<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        // 1. Ambil data input dari form login
        $email = trim($request->input('email'));
        $password = $request->input('password');
        $mode = $request->input('mode'); // Pastikan front-end mengirimkan mode ('admin' / 'company')

        // 2. Tentukan role berdasarkan mode pilihan login
        $role = ($mode === 'admin') ? 'admin' : 'company';

        // 3. Cari user di database berdasarkan email DAN role
        $user = DB::table('users')
            ->where('email', $email)
            ->where('role', $role)
            ->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau hak akses (role) tidak terdaftar.'
            ], 401);
        }

        // 4. Proses pengecekan password menggunakan Hash::check (Bcrypt)
        $passwordMatches = false;

        // Cek pakai Bcrypt bawaan Laravel
        if (Hash::check($password, $user->password)) {
            $passwordMatches = true;
        } 
        // Cadangan: Cek kecocokan teks murni (plain text) jika ada data lama
        else if ($password === $user->password) {
            $passwordMatches = true;
        }

        // Jika password salah / tidak cocok
        if (!$passwordMatches) {
            return response()->json([
                'success' => false,
                'message' => 'Password yang Anda masukkan salah.'
            ], 401);
        }

        // 5. Jika lolos semua, buat Session login
        session([
            'user_id'    => $user->id_user, // sesuaikan dengan nama primary key di tabelmu
            'user_email' => $user->email,
            'user_type'  => $user->role,
            'user_name'  => $user->username ?? 'Admin'
        ]);

        // 6. Kembalikan response sukses beserta rute dashboard-nya
        $redirectUrl = ($user->role === 'admin') ? url('/admin-dashboard') : url('/dashboard');

        return response()->json([
            'success' => true,
            'message' => 'Login Berhasil!',
            'redirect' => $redirectUrl
        ]);
    }
}