<?php

namespace App\Http\Controllers\Halo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HaloController extends Controller
{
    public function index()
    {
        $nama = 'joko';
        $biodata = 'saya tinggal di samarinda';
        $data = [
            'namaJoko' => $nama,
            'biodataJoko' => $biodata,
        ];
        return view('coba.halo', $data);
    }
}
