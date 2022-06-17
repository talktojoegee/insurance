<?php

namespace Modules\Policy\Entities;

use Illuminate\Database\Eloquent\Model;

class VehicleInfo extends Model
{
    protected $fillable = [];

    public function getVehicleMake(){
        return $this->belongsTo(Make::class, 'vehicle_make');
    }

    public function getStateIssued(){
        return $this->belongsTo(State::class, 'state_issued');
    }
}
