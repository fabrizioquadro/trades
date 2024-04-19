<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtivoCorretora extends Model
{
    use HasFactory;

    protected $table = "ativo_corretoras";

    protected $fillable = [
        'id_ativo',
        'id_corretora',
    ];
}
