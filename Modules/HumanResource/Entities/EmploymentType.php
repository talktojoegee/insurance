<?php

namespace Modules\HumanResource\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class EmploymentType extends Model
{
    protected $fillable = [];

        public function addedBy(){
    	return $this->belongsTo(User::class, 'added_by');
    }

    public function getEmploymentTypes(){
            return EmploymentType::orderBy('name', 'ASC')->get();
    }
}
