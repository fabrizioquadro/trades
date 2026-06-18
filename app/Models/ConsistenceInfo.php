<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsistenceInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'riskReward',
        'weeks',
        'months',
        'gainsLosses',
        'trades',
    ];
}
