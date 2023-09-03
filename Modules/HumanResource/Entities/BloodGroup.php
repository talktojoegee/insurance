<?php

namespace Modules\HumanResource\Entities;

use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    protected $fillable = [];

    public function getBloodGroups(){
        return BloodGroup::all();
    }
}
