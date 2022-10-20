<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function update_at()
    {

        $update_at = Carbon::now("Asia/Jakarta")->format('Y-m-d H:i:s');
        return $update_at;
    }
    public function today()
    {

        $today = Carbon::now("Asia/Jakarta")->format('Y-m-d');
        return $today;
    }
}
