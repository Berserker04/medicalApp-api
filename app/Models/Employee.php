<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'document',
        'cellPhone',
        'profession_id',
        'specialty_id',
    ];

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
}
