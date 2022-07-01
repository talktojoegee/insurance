<?php

namespace Modules\Accounting\Entities;

use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    protected $fillable = [];
    protected $primaryKey = 'coa_id';
    public function getParentAccountById($accountId){
        return Coa::find($accountId);
    }
}
