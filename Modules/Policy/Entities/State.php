<?php

namespace Modules\Policy\Entities;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [];

    public function getStates(){
        return State::orderBy('state_name', 'ASC')->get();
    }
}
