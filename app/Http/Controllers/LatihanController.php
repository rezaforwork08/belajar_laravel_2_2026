<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{
    // biodata_user
    // user.text
    // biodata_product
    // product.txt

    public function index()
    {
        // laravel index : akan di load di awal
        return view('latihan');
    }

    public function tambah()
    {
        $jumlah = 0;
        $title = 'Testing';
        // return view('tambah', ['jumlah'=> $jumlah]);
        return view('tambah', compact('jumlah', 'title'));
    }

    public function actionTambah(Request $request)
    {
        $angka1 = $request->angka_1;
        $angka2 = $request->input('angka_2');

        $jumlah = $angka1 + $angka2;
        return view('tambah', compact('jumlah'));
    }

    public function kurang()
    {
        return view('kurang');
    }

    public function kali()
    {
        return view('kali');
    }

    public function bagi()
    {
        return view('bagi');
    }
}
