<?php

namespace App\Models\institucion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntesExternos extends Model
{
    use HasFactory;
    protected $table = "entes_externos";


      protected $fillable = [
        'name'
    ];
}
