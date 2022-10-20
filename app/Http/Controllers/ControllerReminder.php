<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class ControllerReminder extends Controller
{
    public function show_reminder()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $today = new Controller;
            // $response = DB::table('t_reminder')
            //     ->select('*')
            //     ->join('r_keterangan', 'r_keterangan.id_keterangan', 't_reminder.id_keterangan')
            //     ->orderBy('jadwal_kegiatan', 'asc')
            //     ->get();
            $response = DB::select('SELECT *,t_reminder.update_by as pic_r,t_satwa.nama_satwa, timestampdiff(day, jadwal_kegiatan, curdate()) as sisa_hari FROM t_reminder 
            INNER JOIN r_keterangan on t_reminder.id_keterangan = r_keterangan.id_keterangan
            INNER JOIN t_satwa on t_reminder.id_satwa = t_satwa.id_satwa 
            INNER JOIN r_ras on t_satwa.id_ras = r_ras.id_ras 
            ORDER BY status_remin desc');
            $satwa = DB::table('t_satwa')->select('*')->get();
            $keterangan = DB::table('r_keterangan')->select('*')->get();
            $pic_pj = DB::table('t_pic')->select('*')->get();
            $today = $today->today();
            if (session('role') == 1) {
                return view('adm.reminder', compact('response', 'satwa', 'keterangan', 'pic_pj', 'today'));
            } else {
                return view('pic.reminder', compact('response', 'satwa', 'keterangan', 'pic_pj', 'today'));
            }
        }
    }

    public function new_reminder(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $response = DB::table('t_reminder')->insert([
                "id_satwa" => $request->id_satwa,
                "jadwal_kegiatan" => $request->tgl_kegiatan,
                "id_keterangan" => $request->keterangan,
                "note" => $request->note,
                "status_remin" => '9',
                "update_by" => session('id_pic'),
                "update_at" => $update_at->update_at(),
            ]);
            Alert::success('Success!', 'Reminder Berhasil Dibuat.');
            return redirect('admRemin');
        }
    }

    public function update_reminder(Request $request, $id_reminder)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            // variable
            $update_at = new Controller;
            $response = DB::table('t_reminder')
                ->where('id_reminder', $id_reminder)
                ->update([
                    "note" => $request->note,
                    "status_remin" => $request->status,
                    "update_by" => session('id_pic'),
                    "update_at" => $update_at->update_at(),
                ]);
            // return $update_at->update_at();
            Alert::success('Success!', 'Update Data Berhasil.');
            return redirect('admRemin');
        }
    }
    public function hapus_reminder($id_reminder)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::table('t_reminder')
                ->where('id_reminder', $id_reminder)
                ->delete();

            Alert::success('Success!', 'Data Berhasil Dihapus.');
            return redirect('admRemin');
        }
    }
}
