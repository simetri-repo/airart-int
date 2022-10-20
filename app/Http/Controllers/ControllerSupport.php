<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class ControllerSupport extends Controller
{
    public function admHome()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $data_satwa = DB::table('t_satwa')
                ->select('*')
                ->join('r_ras', 't_satwa.id_ras', '=', 'r_ras.id_ras')
                ->get();
            $jml_satwa = DB::table('t_satwa')
                ->select('*')
                ->count();
            $jml_satwa_male = DB::table('t_satwa')
                ->select('*')
                ->where('jk', '1')
                ->count();
            $jml_satwa_female = DB::table('t_satwa')
                ->select('*')
                ->where('jk', '2')
                ->count();
            $jml_pic = DB::table('t_pic')
                ->select('*')
                ->count();
            $jml_user_on = DB::table('t_user')
                ->select('*')
                ->where('status', '1')
                ->count();
            $jml_reminder = DB::table('t_reminder')
                ->select('*')
                ->count();
            $jml_reminder_done = DB::table('t_reminder')
                ->select('*')
                ->where('status_remin', '1')
                ->count();
            $jml_reminder_progress = DB::table('t_reminder')
                ->select('*')
                ->where('status_remin', '9')
                ->count();
            $jml_reminder_cancelled = DB::table('t_reminder')
                ->select('*')
                ->where('status_remin', '7')
                ->count();

            $r_anakan = DB::table('r_anakan')
                ->select('*')
                ->get();

            $jml_r_anakan = DB::table('r_anakan')
                ->select('*')
                ->count();
            // dd($r_anakan);

            $v_induk = array();
            for ($i=0; $i < $jml_r_anakan ; $i++) { 
                $a = $r_anakan[$i]->min_usia;
                $ac = $r_anakan[$i]->max_usia;
                $b = $r_anakan[$i]->keterangan_anakan;
                $hh = DB::select("SELECT count(*) as total FROM t_satwa WHERE timestampdiff(month, tgl_lhr, curdate()) >= $a AND timestampdiff(month, tgl_lhr, curdate()) <= $ac");
                // echo $a . "," . $b . "<br>";
                $v_induk[$b] = $hh[0]->total;

                // return var_dump($v_induk);

            }

            // dd($v_induk);

            // SELECT count(*) as total FROM t_satwa WHERE timestampdiff(month, tgl_lhr, curdate()) > 10

            if (session('role') == 1) {
                return view('adm.home', compact('data_satwa', 'jml_satwa', 'jml_satwa_male', 'jml_satwa_female', 'jml_pic', 'jml_user_on', 'jml_reminder_progress', 'jml_reminder_done', 'jml_reminder_cancelled', 'jml_reminder', 'v_induk', 'r_anakan'));
            } else {
                return view('pic.home', compact('data_satwa', 'jml_satwa', 'jml_satwa_male', 'jml_satwa_female', 'jml_pic', 'jml_user_on', 'jml_reminder_progress', 'jml_reminder_done', 'jml_reminder_cancelled', 'jml_reminder', 'v_induk', 'r_anakan'));
            }
        }
    }
    public function new_ras(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $response = DB::table('r_ras')->insert([
                "nama_ras" => $request->input_in,
                "update_by" => session('id_pic'),
                "update_at" => $update_at->update_at()
            ]);
            Alert::success('Success!', 'Data Berhasil Ditambahkan.');
            return redirect('r_ras');
        }
    }
    public function new_lokasi(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $response = DB::table('r_lokasi')->insert([
                "lokasi" => $request->input_in,
                "update_by" => session('id_pic'),
                "update_at" => $update_at->update_at()
            ]);
            Alert::success('Success!', 'Data Berhasil Ditambahkan.');
            return redirect('r_lokasi');
        }
    }
    public function new_keterangan(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $response = DB::table('r_keterangan')->insert([
                "keterangan" => $request->input_in,
                "update_by" => session('id_pic'),
                "update_at" => $update_at->update_at()
            ]);
            Alert::success('Success!', 'Data Berhasil Ditambahkan.');
            return redirect('r_keterangan');
        }
    }
    public function new_status(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $response = DB::table('r_status')->insert([
                "status" => $request->input_in,
                "update_by" => session('id_pic'),
                "update_at" => $update_at->update_at()
            ]);
            Alert::success('Success!', 'Data Berhasil Ditambahkan.');
            return redirect('r_status');
        }
    }
    public function new_anakan(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $response = DB::table('r_anakan')->insert([
                "keterangan_anakan" => $request->kategori,
                "min_usia" => $request->min_usia,
                "max_usia" => $request->max_usia,
                "update_by" => session('id_pic'),
                "update_at" => $update_at->update_at()
            ]);
            Alert::success('Success!', 'Data Berhasil Ditambahkan.');
            return redirect('r_anakan');
        }
    }
    public function update_anakan($id, Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $response = DB::table('r_anakan')
                ->where('id_anakan', $id)
                ->update([
                    "keterangan_anakan" => $request->kategori,
                    "min_usia" => $request->min_usia,
                    "max_usia" => $request->max_usia,
                    "update_by" => session('id_pic'),
                    "update_at" => $update_at->update_at()
                ]);
            Alert::success('Success!', 'Data Berhasil Di Update.');
            return redirect('r_anakan');
        }
    }
    public function hapus_anakan($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $response = DB::table('r_anakan')
            ->where('id_anakan', $id)
                ->delete();
            // Alert::success('Success!', 'Data Berhasil Di Hapus.');
            alert()->info('Deleted', 'Data Berhasil Dihapus.');
            return redirect('r_anakan');
        }
    }
    public function hapus_ras($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $response = DB::table('r_ras')
            ->where('id_ras', $id)
                ->delete();
            // Alert::success('Success!', 'Data Berhasil Di Hapus.');
            alert()->info('Deleted', 'Data Berhasil Dihapus.');
            return redirect('r_ras');
        }
    }
    public function hapus_lokasi($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $response = DB::table('r_lokasi')
            ->where('id_lokasi', $id)
                ->delete();
            // Alert::success('Success!', 'Data Berhasil Di Hapus.');
            alert()->info('Deleted', 'Data Berhasil Dihapus.');
            return redirect('r_lokasi');
        }
    }
    public function hapus_status($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $response = DB::table('r_status')
            ->where('id_status', $id)
                ->delete();
            // Alert::success('Success!', 'Data Berhasil Di Hapus.');
            alert()->info('Deleted', 'Data Berhasil Dihapus.');
            return redirect('r_status');
        }
    }
    public function hapus_keterangan($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $response = DB::table('r_keterangan')
            ->where('id_keterangan', $id)
                ->delete();
            // Alert::success('Success!', 'Data Berhasil Di Hapus.');
            alert()->info('Deleted', 'Data Berhasil Dihapus.');
            return redirect('r_keterangan');
        }
    }
}
