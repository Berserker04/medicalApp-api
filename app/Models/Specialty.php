<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    public function profession()
    {
        return $this->belongsTo(Profession::class, "profession_id");
    }
}
