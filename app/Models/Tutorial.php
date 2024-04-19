<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;

    protected $table = "tutoriais";

    protected $fillable = [
        'nmTutorial',
        'dsTutorial',
        'dsVideo',
        'tag',
    ];

    public static function buscaTags(){
        $sql = "SELECT DISTINCT tag FROM tutoriais ORDER BY tag";
        return \DB::select($sql);
    }
}
