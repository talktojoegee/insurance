<?php

namespace Modules\Policy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function showNaicomReport(){
        return view('policy::report.naicom');
    }

}
