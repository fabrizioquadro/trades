<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMensagem extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'dtHrMensagem',
        'dsMensagem',
        'dsEmissor',
    ];
}
