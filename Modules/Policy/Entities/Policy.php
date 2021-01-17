<?php

namespace Modules\Policy\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Policy\Entities\Client;
use Modules\Policy\Entities\BusinessClass;
use Modules\Policy\Entities\SubBusinessClass;
use Modules\Policy\Entities\Agent;
use Modules\Accounting\Entities\Currency;

class Policy extends Model
{
    protected $fillable = [];

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
    public function getCurrency(){
    	return $this->belongsTo(Currency::class, 'currency');
    }
    public function getVehicles(){
    	return $this->hasMany(VehicleInfo::class, 'policy_no', 'policy_number');
    }
}
