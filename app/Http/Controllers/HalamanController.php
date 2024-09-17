<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HalamanController extends Controller
{
    public function index()
{
   // Logika default jika peran tidak cocok
    return view('welcome');
}

}
