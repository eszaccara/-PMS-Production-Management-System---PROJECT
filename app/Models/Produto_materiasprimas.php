<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto_materiasprimas extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_produto',
        'id_materiaprima',
        'quantidade',
        'und_id',
    ];
    public function mp_original()
    {
        return $this->belongsTo(Materiaprima::class, 'id_materiaprima');
    }
    public function mp_und()
    {
        return $this->belongsTo(Unidade::class, 'und_id');
    }

}
