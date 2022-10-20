<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerLogin extends Controller
{
    public function login(Request $request)
    {

        $pass = md5($request->password);
        // return $pass;

        $cek = DB::table('t_user')
            ->select('*')
            ->where('username', $request->username)
            ->where('password', $pass)
            ->orwhere('id_pic', $request->username)
            ->where('password', $pass)
            ->count();

        // return $cek;
        if ($cek == 1) {
            $aktif = DB::table('t_user')
                ->select('*')
                ->where('username', $request->username)
                ->where('password', $pass)
                ->orwhere('id_pic', $request->username)
                ->where('password', $pass)
                ->get();
            if ($aktif[0]->status == 9) {
                Alert::error('Oops!', 'Akun Anda Dalam Pengawsan, Kontak Admin!');
                return redirect('/');
            } else {
                $online = DB::table('t_user')
                    ->where('username', $request->username)
                    ->update([
                        'status' => '1'
                    ]);
                Session::put('username', $aktif[0]->username);
                session::put('id_pic', $aktif[0]->id_pic);
                session::put('role', $aktif[0]->role);
                session::put('time_log', time());
                if ($aktif[0]->role == 1) {
                    return redirect('admHome');
                } else {
                    return redirect('picHome');
                }
            }
        } else {
            Alert::error('Err!', 'Periksa Kembali Username dan Password anda!');
            return redirect('/');
        }
    }
    public function Logout()
    {
        $online = DB::table('t_user')
            ->where('username', session('username'))
            ->update([
                'status' => '3'
            ]);
        session::forget('username');
        session::forget('id_pic');
        return redirect('/');
    }
}
