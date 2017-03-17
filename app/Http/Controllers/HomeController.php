<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\RedirectResponse;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response|RedirectResponse
     */
    public function clearCache()
    {
        if (! $this->checkPerm('edit.settings')) {
            \Flash::error( trans('modules.access_denied'));

            return new RedirectResponse( url('/') );
        }

        $exitCodeCache = \Artisan::call('cache:clear');
        $exitCodeView = \Artisan::call('view:clear');
        //clearCache
        $result = 'Cache code: ' . $exitCodeCache . '; View code: ' . $exitCodeView;
        \Flash::info($result);
        return redirect()->back();
    }
}
