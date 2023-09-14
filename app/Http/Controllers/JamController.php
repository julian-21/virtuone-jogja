<?php

namespace App\Http\Controllers;
use App\Models\Jam;
use Illuminate\Http\Request;

class JamController extends Controller
{
    public function index()
    {
        // Dapatkan daftar jam yang tersedia
        $jams = Jam::doesntHave('formulirs')->get();

        return view('jam.index', compact('jams'));
    }
}