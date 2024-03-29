<?php

namespace Modules\Policy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClaimAttachment extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Policy\Database\factories\ClaimAttachmentFactory::new();
    }
}
