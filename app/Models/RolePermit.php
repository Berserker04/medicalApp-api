<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermit extends Model
{
    use HasFactory;

    public function permit(){
        return $this->belongsTo(Permit::class);
    }
}
