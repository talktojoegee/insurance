<?php

namespace Modules\Policy\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [];

    public function getClientPolicies(){
        return $this->hasMany(Policy::class, 'client_id');
    }
    public function getClientDebitNotes(){
        return $this->hasMany(DebitNote::class, 'client_id');
    }
}
