<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaSaqueDeposito extends Model
{
    use HasFactory;

    protected $table = "contas_saques_depositos";

    protected $fillable = [
        'id_conta',
        'dtMovimento',
        'vlMovimento',
        'tpMovimento',
    ];
}
