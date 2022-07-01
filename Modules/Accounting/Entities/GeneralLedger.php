<?php

namespace Modules\Accounting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GeneralLedger extends Model
{
    protected $fillable = [];

    public function publishGeneralLedger($glCode, $postedBy, $narration, $drAmount, $crAmount, $refNo, $bank, $ob){
        $ledger = new GeneralLedger();
        $ledger->glcode = $glCode;
        $ledger->posted_by = $postedBy ?? Auth::user()->id;
        $ledger->narration = $narration ?? 'General ledger entry';
        $ledger->dr_amount = $drAmount;
        $ledger->cr_amount = $crAmount;
        $ledger->ref_no = $refNo;
        $ledger->bank = $bank ?? 0;
        $ledger->ob = $ob ?? 0;
        $ledger->save();
    }
}
