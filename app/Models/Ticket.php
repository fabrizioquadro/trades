<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'dtHrTicket',
        'dsAssunto',
        'dsTicket',
        'stTicket',
        'stLidoAdm',
        'stLidoAluno',
    ];

    public function aluno(){
        return $this->belongsTo(Aluno::class);
    }
}
