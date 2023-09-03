<?php

namespace Modules\HumanResource\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genotype extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\HumanResource\Database\factories\GenotypeFactory::new();
    }

    public function getAllGenotypes(){
        return Genotype::all();
    }
}
