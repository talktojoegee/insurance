<?php

namespace Modules\Policy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Client extends Model
{
    protected $fillable = [];

    public function getClientPolicies(){
        return $this->hasMany(Policy::class, 'client_id');
    }
    public function getClientDebitNotes(){
        return $this->hasMany(DebitNote::class, 'client_id');
    }

    public function getClientCreditNotes(){
        return $this->hasMany(CreditNote::class, 'client_id');
    }

    public function getClientClaims(){
        return $this->hasMany(Claim::class, 'client_id');
    }


    public function createClient(Request $request){
        $client = new Client;
        $client->insured_name = $request->insured_name;
        $client->email = $request->email;
        $client->mobile_no = $request->mobile_number;
        $client->address = $request->address;
        $client->password = bcrypt(substr(sha1(time()),32,40 ));
        $client->slug = substr(sha1(time()),24,40 );
        $client->save();
        return $client;
    }

    public function getAllClients(){
        return Client::orderBy('id', 'DESC')->get();
    }
}
