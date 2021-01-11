<?php

namespace Modules\HumanResource\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Department extends Model
{
    protected $fillable = [
    	'name'
    ];

    public function addedBy(){
    	return $this->belongsTo(User::class, 'added_by');
    }
}
