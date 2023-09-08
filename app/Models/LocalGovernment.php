<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Policy\Entities\State;

class LocalGovernment extends Model
{
    use HasFactory;


    public function getState(){
        return $this->belongsTo(State::class, 'state_id');
    }


    /*
     * Use-case
     */

    public function getAllLocalGovernmentAreas(){
        return LocalGovernment::orderBy('state_id', 'ASC')->get();
    }

    public function getLocalGovernmentsByStateId($id){
        return LocalGovernment::where('state_id', $id)->orderBy('local_name', 'ASC')->get();
    }
}
