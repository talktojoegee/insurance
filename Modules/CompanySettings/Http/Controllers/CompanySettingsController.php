<?php

namespace Modules\CompanySettings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CompanySettings\Entities\SettingsGeneral;

class CompanySettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $settings = SettingsGeneral::first();
        return view('companysettings::index', ['settings'=>$settings]);
    }
    public function generalSettings(Request $request)
    {
        $request->validate([
            'company_name'=>'required',
            'official_email'=>'required',
            'office_phone_1'=>'required',
            'office_address'=>'required'
        ]);
        $settings = SettingsGeneral::first();
        if(!empty($settings)){
            $settings->company_name = $request->company_name;
            $settings->official_email = $request->official_email;
            $settings->office_phone_1 = $request->office_phone_1;
            $settings->office_phone_2 = $request->office_phone_2;
            $settings->office_address = $request->office_address;
            $settings->tagline = $request->tagline;
            $settings->company_prefix = $request->company_prefix;
            $settings->postal_code = $request->postal_code;
            $settings->office_address = $request->office_address;
            $settings->save();
            session()->flash("success", "<strong>Success!</strong> Changes to general settings saved.");
            return back();
        }else{
            $settings = new SettingsGeneral;
            $settings->company_name = $request->company_name;
            $settings->official_email = $request->official_email;
            $settings->office_phone_1 = $request->office_phone_1;
            $settings->office_phone_2 = $request->office_phone_2;
            $settings->office_address = $request->office_address;
            $settings->tagline = $request->tagline;
            $settings->company_prefix = $request->company_prefix;
            $settings->postal_code = $request->postal_code;
            $settings->office_address = $request->office_address;
            $settings->save();
            session()->flash("success", "<strong>Success!</strong> Changes to general settings saved.");
            return back();
        }

    }

    public function assetsSettings(Request $request){
        //return dd($request->all());
        $request->validate([
            'company_logo'=>'required',
            'company_favicon'=>'required'
        ]);
        #Logo
        if (!empty($request->file('company_logo'))) {
            $extension = $request->file('company_logo');
            $extension = $request->file('company_logo')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/attachments/assets/logo/';
            $logo = 'logo_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $request->file('company_logo')->move(public_path($dir), $logo);
        }
        #Favicon
        if (!empty($request->file('company_favicon'))) {
            $extension = $request->file('company_favicon');
            $extension = $request->file('company_favicon')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/attachments/assets/favicon/';
            $favicon = 'favicon_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $request->file('company_favicon')->move(public_path($dir), $favicon);
        }
        $settings = SettingsGeneral::first();
        if(!empty($settings)){
            $settings->company_logo = $logo;
            $settings->company_favicon = $favicon;
            $settings->save();
            session()->flash("success", "<strong>Success!</strong> Company logo and favicon set.");
            return back();
        }else{
            $settings = new SettingsGeneral;
            $settings->company_logo = $logo;
            $settings->company_favicon = $favicon;
            $settings->save();
            session()->flash("success", "<strong>Success!</strong> Company logo and favicon set.");
            return back();
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('companysettings::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('companysettings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('companysettings::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
