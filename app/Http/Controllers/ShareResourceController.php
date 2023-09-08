<?php

namespace App\Http\Controllers;

use App\Models\LocalGovernment;
use Illuminate\Http\Request;

class ShareResourceController extends Controller
{

    public function __construct(){
       $this->localgovernment = new LocalGovernment();
    }



    public function loadLocalGovernments(Request $request){
        $this->validate($request,[
            'state'=>'required'
        ]);
        $lgas = $this->localgovernment->getLocalGovernmentsByStateId($request->state);
        return view('partials._local-governments', ['lgas'=>$lgas]);
    }
}
