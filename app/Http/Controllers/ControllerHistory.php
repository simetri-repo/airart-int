<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;



class ControllerHistory extends Controller
{
    public function show_history()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::select('SELECT *,a.update_at as tgl_akhir, a.update_by as update_oleh FROM t_history as a 
                                    INNER JOIN t_satwa ON a.id_satwa = t_satwa.id_satwa
                                    INNER JOIN r_status ON a.id_status = r_status.id_status
                                    INNER JOIN r_lokasi ON a.id_lokasi = r_lokasi.id_lokasi
                                    INNER JOIN r_ras ON t_satwa.id_ras = r_ras.id_ras
                                    where a.update_at = (select max(update_at) from t_history where a.id_satwa = t_history.id_satwa)
                                    order by a.update_at DESC');
            $his_satwa = DB::table('t_history')->select('*')->get();
            $satwa = DB::table('t_satwa')->select('*')->get();
            $status = DB::table('r_status')->select('*')->get();
            $kandang = DB::table('r_lokasi')->select('*')->get();
            if (session('role') == 1) {
                return view('adm.data_history', compact('response', 'his_satwa', 'satwa', 'status', 'kandang'));
            } else {
                return view('pic.data_history', compact('response', 'his_satwa', 'satwa', 'status', 'kandang'));
            }
        }
    }

    public function show_history_id($id_satwa, $nama_satwa)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::select('SELECT *,a.update_at as update_akhir, a.update_by as update_oleh FROM t_history as a 
                                    INNER JOIN t_satwa as b ON a.id_satwa = b.id_satwa
                                    INNER JOIN r_status as c ON a.id_status = c.id_status
                                    INNER JOIN r_lokasi as d ON a.id_lokasi = d.id_lokasi
                                    WHERE a.id_satwa = "' . $id_satwa . '"');
            if (session('role') == 1) {
                return view('adm.data_history_id', compact('id_satwa', 'nama_satwa', 'response'));
            } else {
                return view('pic.data_history_id', compact('id_satwa', 'nama_satwa', 'response'));
            }
        }
    }

    public function new_history(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $response = DB::table('t_history')->insert([

                "id_satwa" => $request->id_satwa,
                "id_status" => $request->status,
                "bb" => $request->bb,
                "tinggi" => $request->tinggi,
                "panjang" => $request->panjang,
                "id_lokasi" => $request->kandang,
                "note" => $request->note,
                "update_by" => session('id_pic'),
                "update_at" => $update_at->update_at()
            ]);

            Alert::success('Success!', 'Data Berhasil Ditambahkan.');
            return redirect('admDathistory');
        }
    }
}
