<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GabunganController extends Controller
{

    public function index()
    {
        $joins = DB::table('mobils')
            ->join('pemiliks', 'mobils.ktp_pemilik', '=', 'pemiliks.ktp_pemilik')
            ->select('mobils.merk as merk', 'pemiliks.ktp_pemilik as ktp_pemilik', 'pemiliks.nama as nama')
            ->paginate(6);
            return view('gabungan.index',compact('joins')) 
                ->with('i', (request()->input('page', 1)-1)*6);
    }
}
