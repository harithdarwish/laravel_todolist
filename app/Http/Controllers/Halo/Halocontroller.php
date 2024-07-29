<?php

namespace App\Http\Controllers\Halo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Halocontroller extends Controller
{
    public function index1()
    {
        return '<h1> Halo dari controller</h1>';
    }
    public function index2()
    {
        $name1 = 'Harith';
        $data1 = ['firstname1' => $name1];

        $name2 = 'Darwish';
        $data2 = ['lastname1' => $name2];

        return view('coba.halo', $data1,$data2);
    }

}

