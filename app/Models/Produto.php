<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'nome',
        'descricao',
        'porcentagemVenda',
    ];

    public function mps()
    {
        return $this->hasMany(Produto_materiasprimas::class, 'id_produto');
    }

    public function unidades()
    {
        return $this->belongsTo(Unidade::class, 'und_id');
    }
}
