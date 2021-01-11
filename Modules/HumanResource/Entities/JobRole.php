<?php

namespace Modules\HumanResource\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HumanResource\Entities\Department;
use App\Models\User;

class JobRole extends Model
{
    protected $fillable = [];

    public function roleDepartment(){
    	return $this->belongsTo(Department::class, 'department_id');
    }

    public function addedBy(){
    	return $this->belongsTo(User::class, 'added_by');
    }
}
