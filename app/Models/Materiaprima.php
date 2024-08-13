<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiaprima extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'nome',
        'quantidade',
        'und_id',
        'valor',
    ];

    public function unidades()
    {
        return $this->belongsTo(Unidade::class, 'und_id');
    }
}
