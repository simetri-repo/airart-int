<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\DB;

class ControllerRKategori extends Controller
{
    public function show_r_ras()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::table('r_ras')->select('*')->get();
            return view('adm.r_ras', compact('response'));
        }
    }
    public function show_r_lokasi()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::table('r_lokasi')->select('*')->get();
            return view('adm.r_lokasi', compact('response'));
        }
    }
    public function show_r_keterangan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::table('r_keterangan')->select('*')->get();
            return view('adm.r_keterangan', compact('response'));
        }
    }
    public function show_r_status()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::table('r_status')->select('*')->get();
            return view('adm.r_status', compact('response'));
        }
    }
    public function show_r_anakan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::table('r_anakan')->select('*')->get();
            return view('adm.r_anakan', compact('response'));
        }
    }
}
