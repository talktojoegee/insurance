<?php

namespace Modules\Policy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CompanySettings\Entities\SettingsGeneral;
use Modules\Policy\Entities\Policy;
use Modules\Policy\Entities\DebitNote;
use Modules\Accounting\Entities\Currency;
use Modules\Policy\Entities\SettingsAccount;
use Carbon\Carbon;
use Auth;

class DebitNoteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->debitnote = new DebitNote();
        $this->policy = new Policy();
        $this->currency = new Currency();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $list = $this->debitnote->getDebitNotes();
        return view('policy::debit-note.index',
            [
                'list'=>$list,
                'thisYearDebitNotes'=>$this->debitnote->getThisYearDebitNotes()
            ]);
    }

    public function create($slug){
        $policy = $this->policy->getPolicyBySlug($slug);
        if(!empty($policy)){
            $debitCode = null;
            $debit = $this->debitnote->getLastDebitNote();
            $currencies = $this->currency->getCurrencies();
            if(!empty($debit)){
                $debitCode =$debit->debit_code + 1;
            }else{
                $debitCode = 100000;
            }
            return view('policy::debit-note.create', ['policy'=>$policy, 'debitCode'=>$debitCode,'currencies'=>$currencies]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record not found.");
            return back();
        }
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function storeNewDebitNote(Request $request)
    {

        $request->validate([
    		'debit_code_number'=>'required|unique:debit_notes,debit_code',
    		'sum_insured'=>'required',
    		'premium_rate'=>'required',
    		'commission_rate'=>'required',
    		'payment_mode'=>'required',
    		'net_amount'=>'required',
    		'gross_premium'=>'required',
            'commission'=>'required',
            'policy_number'=>'required',
            'business_type'=>'required',
            'option'=>'required',
            'currency'=>'required',
            'class'=>'required',
            'sub_class'=>'required',
            'vatChecked'=>'required'
    	],[
            'business_type.required'=>'Select business type',
            'option.required'=>'Select option',
            'currency.required'=>'Choose transaction currency',
            'commission.required'=>'Enter your commission rate',
        ]);
        $policy = $this->policy->getPolicyByPolicyNo($request->policy_number);
        if(!empty($policy)){
            $this->debitnote->createDebitNote($request, $policy->getAgency->id);

            session()->flash("success", "<strong>Success!</strong> Debit note registered. Pending approval.");
            return redirect('/policy/debit-notes');
        }else{
            session()->flash("error", "Something went wrong. Try again.");
            return back();
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function view($slug)
    {
        $debit = $this->debitnote->getDebitNoteBySlug($slug);
        if(!empty($debit)){
            $settings = SettingsGeneral::first();
            return view('policy::debit-note.view',['debit'=>$debit, 'settings'=>$settings]);
        }else{
            session()->flash("error", "Something went wrong. Check and try again.");
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('policy::edit');
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
