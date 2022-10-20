<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class ControllerSatwa extends Controller
{
    public function show_satwa()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::select('SELECT *, timestampdiff(year, tgl_lhr, curdate()) as umur_thn, timestampdiff(month, tgl_lhr, curdate()) as umur_bln, timestampdiff(day, tgl_lhr, curdate()) as umur_hari, t_satwa.update_by as update_oleh, t_satwa.update_at as update_pada FROM t_satwa INNER JOIN r_ras on t_satwa.id_ras = r_ras.id_ras');
            $ras = DB::table('r_ras')->select('*')->get();
            $induk_jantan = DB::table('t_satwa')
                ->select('*')
                ->where('jk', 1)
                ->get();
            $induk_betina = DB::table('t_satwa')
                ->select('*')
                ->where('jk', 2)
                ->get();
            $anakan = DB::table('r_anakan')->select('*')->get();
            $total_anakan = DB::table('r_anakan')->select('*')->count();
            $dt_pic = DB::table('t_pic')->select('*')->get();



            if (session('role') == 1) {
                return view('adm.data_satwa', compact('response', 'ras', 'induk_jantan', 'induk_betina', 'anakan', 'total_anakan', 'dt_pic'));
            } else {
                return view('pic.data_satwa', compact('response', 'ras', 'induk_jantan', 'induk_betina', 'anakan', 'total_anakan', 'dt_pic'));
            }
        }
    }
    public function new_satwa(Request $request)
    {


        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $validator = Validator::make($request->all(), [
                'foto_satwa' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2040',
                'nama_satwa' => 'required',
                'ras' => 'required',
                'jk' => 'required',
                'tgl_lhr' => 'required',

            ]);



            // ddd($request->all());

            // id_satwa
            $id_sat_tb = DB::table('t_satwa')->max('id_satwa');
            $noUrut = (int) substr($id_sat_tb, 3, 3);
            $noUrut++;
            $char = "STW";
            $id_sat_new = $char . sprintf("%03s", $noUrut);
            // upload_gambar
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('foto_satwa');
            // $size = $request->file('foto_satwa')->getSize();
            // isi dengan nama folder tempat kemana file diupload

            if ($validator->fails()) {
                Alert::error('Gagal!', 'Periksa kembali jenis dan ukuran file, dan pastikan data sudah terisi semua!');
                return redirect('admDatsat');
            } else {
                // if($size > 2040){
                //     Alert::error('Gagal!', 'Ukuran file foto terlalu besar!');
                //     return redirect('admDatsat');
                // }else{
                if ($file == null) {
                    $path_mtools = '';
                } else {


                    $nama_file = time() . "_" . $file->getClientOriginalName();
                    $tujuan_upload = 'foto_satwa/';
                    $file->move($tujuan_upload, $nama_file);
                    // return $size;
                    $path_mtools = $tujuan_upload . $nama_file;
                }

                if ($request->takaran == null) {
                    $tkr = 0;
                } else {
                    $tkr = $request->takaran;
                }


                // 
                $update_at = new Controller;
                // ada file yang diupload
                $response = DB::table('t_satwa')->insert([
                    "id_satwa" => $id_sat_new,
                    "nama_satwa" => $request->nama_satwa,
                    "id_ras" => $request->ras,
                    "jk" => $request->jk,
                    "id_ayah" => $request->induk_jantan,
                    "id_ibu" => $request->induk_betina,
                    "tgl_lhr" => $request->tgl_lhr,
                    "update_by" => session('id_pic'),
                    "update_at" => $update_at->update_at(),
                    "foto_satwa" => $path_mtools,
                    "pic_pj" => $request->pic_pj,
                    "takaran" => $tkr,
                ]);

                Alert::success('Success!', 'Data Berhasil Ditambahkan.');
                return redirect('admDatsat');
                // }
            }
        }
    }
    public function update_satwa(Request $request, $id_satwa)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $validator = Validator::make($request->all(), [
                // 'foto_satwa' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2040',
                'foto_satwa_up' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2040'
            ]);
            // foto_satwa
            $file = $request->file('foto_satwa_up');

            // 

            $update_at = new Controller;
            if ($validator->fails()) {
                Alert::error('Gagal!', 'Periksa kembali jenis dan ukuran file, dan pastikan data sudah terisi semua!');
                return redirect('admDatsat');
            } else {
                // isi dengan nama folder tempat kemana file diupload
                if ($file == null) {
                    $ft_s = $request->foto_satwa;
                } else {
                    // menyimpan data file yang diupload ke variabel $file
                    $nama_file = time() . "_" . $file->getClientOriginalName();
                    $tujuan_upload = 'foto_satwa/';
                    $file->move($tujuan_upload, $nama_file);

                    $path_mtools = $tujuan_upload . $nama_file;
                    $ft_s = $path_mtools;
                }

                $response = DB::table('t_satwa')
                    ->where('id_satwa', $id_satwa)
                    ->update([
                        "nama_satwa" => $request->nama_satwa,
                        "id_ras" => $request->ras,
                        "jk" => $request->jk,
                        "id_ayah" => $request->induk_jantan,
                        "id_ibu" => $request->induk_betina,
                        "tgl_lhr" => $request->tgl_lhr,
                        "update_by" => session('id_pic'),
                        "update_at" => $update_at->update_at(),
                        "foto_satwa" => $ft_s,
                        "pic_pj" => $request->pic_pj,
                        "takaran" => $request->takaran,
                    ]);

                Alert::success('Success!', 'Data Berhasil Diupdate.');
                return redirect('admDatsat');
            }
        }
    }
    public function cari_satwa(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            if ($request->id_satwa == '' and $request->nama_satwa == '' and $request->ras == '' and $request->jk == '') {
                $response = DB::table('t_satwa')->select('*')->get();
            } elseif ($request->id_satwa != '' and $request->nama_satwa == '' and $request->ras == '' and $request->jk == '') {
                $response = DB::select('SELECT * FROM t_satwa WHERE id_satwa Like "' . $request->id_satwa . '%"');
            } elseif ($request->id_satwa == '' and $request->nama_satwa != '' and $request->ras == '' and $request->jk == '') {
                $response = DB::select('SELECT * FROM t_satwa WHERE nama_satwa Like "' . $request->nama_satwa . '%"');
            } elseif ($request->id_satwa == '' and $request->nama_satwa == '' and $request->ras != '' and $request->jk == '') {
                $response = DB::select('SELECT * FROM t_satwa WHERE id_ras = "' . $request->ras . '"');
            } elseif ($request->id_satwa == '' and $request->nama_satwa == '' and $request->ras == '' and $request->jk != '') {
                $response = DB::select('SELECT * FROM t_satwa WHERE jk = "' . $request->jk . '"');
            } elseif ($request->id_satwa == '' and $request->nama_satwa == '' and $request->ras != '' and $request->jk != '') {
                $response = DB::select('SELECT * FROM t_satwa WHERE jk = "' . $request->jk . '" AND id_ras = "' . $request->ras . '"');
            } else {
                $response = DB::select('SELECT * FROM t_satwa WHERE id_satwa = "' . $request->id_satwa . '" OR nama_satwa = "' . $request->nama_satwa . '" OR id_ras = "' . $request->ras . '" OR jk = "' . $request->jk . '"');
            }
            $total = count($response);
            $ras = DB::table('r_ras')->select('*')->get();
            if (session('role') == 1) {
                return view('adm.cari_satwa', compact('response', 'ras', 'total'));
            } else {
                return view('pic.cari_satwa', compact('response', 'ras', 'total'));
            }
        }
    }
    public function profile_satwa_id($id_satwa)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::select('SELECT *,a.id_satwa,b.nama_satwa,b.jk,b.id_ayah,b.id_ibu,b.tgl_lhr,c.nama_ras,d.lokasi, a.update_at as tgl_update, a.update_by as pic_update 
            FROM t_history as a 
            INNER JOIN t_satwa as b ON a.id_satwa = b.id_satwa 
            INNER JOIN r_ras as c on b.id_ras = c.id_ras 
            INNER JOIN r_lokasi as d on a.id_lokasi = d.id_lokasi 
            WHERE a.id_satwa = "' . $id_satwa . '" ORDER BY a.update_at DESC LIMIT 1;');

            $usia = DB::select('SELECT timestampdiff(year, tgl_lhr, curdate()) as umur_thn, 
            timestampdiff(month, tgl_lhr, curdate()) as umur_bln, 
            timestampdiff(day, tgl_lhr, curdate()) as umur_hari 
            FROM t_satwa WHERE id_satwa = "' . $id_satwa . '"');

            $history = DB::select('SELECT *,a.update_at as update_akhir, a.update_by as update_oleh FROM t_history as a 
            INNER JOIN t_satwa as b ON a.id_satwa = b.id_satwa
            INNER JOIN r_status as c ON a.id_status = c.id_status
            INNER JOIN r_lokasi as d ON a.id_lokasi = d.id_lokasi
            WHERE a.id_satwa = "' . $id_satwa . '"');

            $reminder = DB::select('SELECT *,t_reminder.update_by as pic_r,t_satwa.nama_satwa, timestampdiff(day, jadwal_kegiatan, curdate()) as sisa_hari FROM t_reminder 
            INNER JOIN r_keterangan on t_reminder.id_keterangan = r_keterangan.id_keterangan
            INNER JOIN t_satwa on t_reminder.id_satwa = t_satwa.id_satwa 
            WHERE t_reminder.id_satwa = "' . $id_satwa . '"');

            $anakan = DB::table('r_anakan')->select('*')->get();
            $total_anakan = DB::table('r_anakan')->select('*')->count();

            $total_has = count($response);
            if ($total_has == 0) {
                Alert::error('Oops!', 'Data History Satwa Belum Tersedia!');
                return redirect('admCarisat');
            } else {

                if (session('role') == 1) {
                    return view('adm.profile_satwa', compact('response', 'usia', 'history', 'reminder', 'anakan', 'total_anakan'));
                } else {
                    return view('pic.profile_satwa', compact('response', 'usia', 'history', 'reminder', 'anakan', 'total_anakan'));
                }
            }
            // dd($response);
            // return count($response);
        }
    }
    public function hapus_satwa($id_satwa)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::table('t_satwa')
                ->where('id_satwa', $id_satwa)
                ->delete();

            Alert::success('Success!', 'Data Berhasil Dihapus.');
            return redirect('admDatsat');
        }
    }
    public function show_satwa_saya()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::select('SELECT *, timestampdiff(year, tgl_lhr, curdate()) as umur_thn, timestampdiff(month, tgl_lhr, curdate()) as umur_bln, timestampdiff(day, tgl_lhr, curdate()) as umur_hari FROM t_satwa INNER JOIN r_ras on t_satwa.id_ras = r_ras.id_ras INNER JOIN t_pic on t_satwa.pic_pj = t_pic.id_pic WHERE t_satwa.pic_pj = "' . session('id_pic') . '"');
            $ras = DB::table('r_ras')->select('*')->get();
            $induk_jantan = DB::table('t_satwa')
                ->select('*')
                ->where('jk', 1)
                ->get();
            $induk_betina = DB::table('t_satwa')
                ->select('*')
                ->where('jk', 2)
                ->get();
            $anakan = DB::table('r_anakan')->select('*')->get();
            $total_anakan = DB::table('r_anakan')->select('*')->count();
            $dt_pic = DB::table('t_pic')->select('*')->get();

            return view('pic.satwa_saya', compact('response', 'ras', 'induk_jantan', 'induk_betina', 'anakan', 'total_anakan', 'dt_pic'));
        }
    }
    public function show_satwa_id($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $response = DB::table('t_satwa')
                ->select('*')
                ->join('r_ras', 't_satwa.id_ras', '=', 'r_ras.id_ras')
                ->where('id_satwa', $id)
                ->get();
            $ras = DB::table('r_ras')->select('*')->get();
            $induk_jantan = DB::table('t_satwa')
                ->select('*')
                ->where('jk', 1)
                ->get();
            $induk_betina = DB::table('t_satwa')
                ->select('*')
                ->where('jk', 2)
                ->get();
            $dt_pic = DB::table('t_pic')->select('*')->get();

            if (session('role') == 1) {
                return view('adm.data_satwa_id', compact('response', 'ras', 'induk_jantan', 'induk_betina', 'dt_pic'));
            } else {
                return view(
                    'pic.data_satwa_id',
                    compact('response', 'ras', 'induk_jantan', 'induk_betina', 'dt_pic')
                );
            }
        }
    }
}
