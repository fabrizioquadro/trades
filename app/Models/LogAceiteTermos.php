<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAceiteTermos extends Model
{
    use HasFactory;

    protected $fillable = ['aluno_id','tpAceite'];

    static public function getUltimoLog($aluno_id, $tpAceite){
        $res = \DB::table('log_aceite_termos')
        ->select('created_at')
        ->where('aluno_id', $aluno_id)
        ->where('tpAceite', $tpAceite)
        ->orderByDesc('created_at')
        ->first();

        return $res->created_at;
    }

    public function aluno(){
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }
}
