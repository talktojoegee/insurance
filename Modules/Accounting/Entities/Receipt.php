<?php

namespace Modules\Accounting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Policy\Entities\Client;
use Modules\Policy\Entities\BusinessClass;
use Modules\Policy\Entities\SubBusinessClass;
use Modules\Policy\Entities\Agent;
use Modules\Policy\Entities\Policy;
use Modules\Accounting\Entities\Currency;
use Modules\Accounting\Entities\Coa;


class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Accounting\Database\factories\ReceiptFactory::new();
    }

    public function getBusinessClass(){
    	return $this->belongsTo(BusinessClass::class, 'class_id');
    }
    public function getSubBusinessClass(){
    	return $this->belongsTo(SubBusinessClass::class, 'sub_class_id');
    }
    public function getAgency(){
    	return $this->belongsTo(Agent::class, 'agency_id');
    }
    public function getClient(){
    	return $this->belongsTo(Client::class, 'client_id');
    }
    public function getPolicy(){
    	return $this->belongsTo(Policy::class, 'policy_no', 'policy_number');
    }
    public function getCurrency(){
    	return $this->belongsTo(Currency::class, 'currency_id');
    }
    public function getAccount(){
    	return $this->belongsTo(Coa::class, 'glcode', 'glcode');
    }
}
