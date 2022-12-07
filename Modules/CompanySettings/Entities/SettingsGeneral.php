<?php

namespace Modules\CompanySettings\Entities;

use Illuminate\Database\Eloquent\Model;

class SettingsGeneral extends Model
{
    protected $fillable = [];

    public static function getCompanyGeneralSettings(){
        return SettingsGeneral::first();
    }
}
