<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $report = Report::orderBy('created_at')->first();
        return view('home',[
            'report' => $report
        ]);
    }
}
