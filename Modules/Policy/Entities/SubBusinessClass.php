<?php

namespace Modules\Policy\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Policy\Entities\SubBusinessClass;

class SubBusinessClass extends Model
{
    protected $fillable = [];

    public function getBusinessClass(){
    	return $this->belongsTo(BusinessClass::class, 'business_class_id');
    }
}
