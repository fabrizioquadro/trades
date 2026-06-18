<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsistenceFase extends Model
{
    use HasFactory;

    protected $fillable = [
        'nmFase',
        'vlInc',
        'vlFn',
        'descricao',
        'icone',
    ];
}
