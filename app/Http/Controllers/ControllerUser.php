<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerUser extends Controller
{
    public function show_user()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $data_pic = DB::table('t_pic')->select('*')->get();
            $response = DB::table('t_user')->select('*')->get();
            return view('adm.data_user', compact('response', 'data_pic'));
        }
    }
    public function show_pic()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::table('t_pic')->select('*')->get();
            return view('adm.data_pic', compact('response'));
        }
    }
    // PIC
    public function new_pic(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // validate
            $notlp = DB::table('t_pic')
                ->select('id_pic')
                ->where('no_hp_pic', $request->no_hp_pic)
                ->count();

            if ($notlp > 0) {
                Alert::error('Oops!', 'No Tlp Sudah Terdaftar!');
                return redirect('admDatpic');
            } else {
                // variable

                $update_at = new Controller;
                $response = DB::table('t_pic')->insert([
                    "id_pic" => $request->nik,
                    "nama_pic" => $request->nama_pic,
                    "tgl_lahir_pic" => $request->tgl_lhr_pic,
                    "no_hp_pic" => $request->no_hp_pic,
                    "update_by" => session('id_pic'),
                    "update_at" => $update_at->update_at()
                ]);
                // return $update_at->update_at();
                Alert::success('Success!', 'Data Berhasil Ditambahkan.');
                return redirect('admDatpic');
                // return $id_pic_tb;
            }
        }
    }
    public function update_pic($id_pic, Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // validate

            $notlp = DB::table('t_pic')
                ->select('*')
                ->where('no_hp_pic', $request->no_hp_pic)
                ->count();
            // return $notlp;
            if ($notlp >= 2) {
                Alert::error('Oops!', 'No Tlp Sudah Tersedia!');
                return redirect('admDatpic');
            } else {
                // variable
                $update_at = new Controller;
                $response = DB::table('t_pic')
                    ->where('id_pic', $id_pic)
                    ->update([
                        "nama_pic" => $request->nama_pic,
                        "tgl_lahir_pic" => $request->tgl_lhr_pic,
                        "no_hp_pic" => $request->no_hp_pic,
                        "update_by" => session('id_pic'),
                        "update_at" => $update_at->update_at()
                    ]);
                // return $update_at->update_at();
                Alert::success('Success!', 'Update Data Berhasil.');
                return redirect('admDatpic');
                // return $response;
                // return $id_pic_tb;
            }
        }
    }

    // USER
    public function new_user(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            // validate
            $pic = DB::table('t_user')
                ->select('id_pic')
                ->where('id_pic', $request->id_pic)
                ->count();

            if ($pic > 0) {
                Alert::error('Oops!', 'Data PIC Sudah Terdaftar!');
                return redirect('admDatusr');
            } else {
                // variable
                $update_at = new Controller;
                $response = DB::table('t_user')->insert([

                    "id_pic" => $request->id_pic,
                    "username" => $request->username,
                    "password" => md5($request->password),
                    "role" => $request->role,
                    "status" => '9',
                    "update_by" => session('id_pic'),
                    "update_at" => $update_at->update_at()
                ]);
                // return $update_at->update_at();
                Alert::success('Success!', 'Akun Berhasil Dibuat.');
                return redirect('admDatusr');
                // return $id_pic_tb;
            }
        }
    }
    public function update_user($id_pic, Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // validate
            // return $request->all();
            $idpic = DB::table('t_user')
                ->select('*')
                ->where('username', $request->username)
                ->count();
            // return $idpic;
            if ($idpic >= 2) {
                Alert::error('Oops!', 'Username Sudah Terdaftar!');
                return redirect('admDatusr');
            } else {
                // variable
                $update_at = new Controller;
                $response = DB::table('t_user')
                    ->where('id_pic', $id_pic)
                    ->update([
                        "username" => $request->username,
                        "role" => $request->role,
                        "status" => $request->status,
                        "update_by" => session('id_pic'),
                        "update_at" => $update_at->update_at()
                    ]);
                // return $update_at->update_at();
                Alert::success('Success!', 'Update Data Berhasil.');
                return redirect('admDatusr');
                // return $response;
                // return $id_pic_tb;
            }
        }
    }

    public function reset_pass($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $reset = DB::table('t_user')
                ->where('id_user', $id)
                ->update([
                    "password" => md5('kennels123')
                ]);
            Alert::success('Success!', 'Update Data Berhasil.');
            return redirect('admDatusr');
        }
    }

    public function dataSaya()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::table('t_user')
                ->select('*')
                ->join('t_pic', 't_user.id_pic', '=', 't_pic.id_pic')
                ->where('t_user.id_pic', session('id_pic'))
                ->get();

            return view('pic.data_saya', compact('response'));
        }
    }

    public function ganti_password(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $reset = DB::table('t_user')
                ->where('id_pic', session('id_pic'))
                ->update([
                    "password" => md5($request->new_pass)
                ]);
            Alert::success('Success!', 'Update Data Berhasil.');
            return redirect('Logout');
        }
    }
}
