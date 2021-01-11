<?php

namespace Modules\CompanySettings\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounting\Entities\Coa;

class SettingsAccount extends Model
{
    protected $fillable = [];


    public function getDebit(){
        return $this->belongsTo(Coa::class, 'dr', 'glcode');
    }
    public function getCredit(){
        return $this->belongsTo(Coa::class, 'cr', 'glcode');
    }
}
