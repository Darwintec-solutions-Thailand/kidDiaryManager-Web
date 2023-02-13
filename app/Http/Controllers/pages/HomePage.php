<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePage extends Controller
{
  public function index()
  {
    $query = "SELECT * FROM analysis_growth_analyst";
    // dd(DB::select($query));
    return view('content.pages.pages-home');
  }
}
