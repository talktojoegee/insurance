<?php

namespace Modules\HumanResource\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AcademicQualification extends Model
{
    protected $fillable = [];

    public function addedBy(){
    	return $this->belongsTo(User::class, 'added_by');
    }

    public function getAcademicQualifications(){
        return AcademicQualification::orderBy('name', 'ASC')->get();
    }
}
