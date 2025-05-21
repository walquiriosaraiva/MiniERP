<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variacao extends Model
{
    protected $table = 'variacoes';

    protected $primaryKey = 'id';

    protected $fillable = ['produto_id', 'nome'];

    public function produto()
    {
        return $this->belongsTo(\App\Models\Produto::class);
    }

}
