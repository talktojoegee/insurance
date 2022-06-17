<?php

namespace Modules\Accounting\Entities;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [];


    public function getCurrencies(){
        return Currency::orderBy('name', 'ASC')->get();
    }
}
