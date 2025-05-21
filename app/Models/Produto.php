<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $primaryKey = 'id';

    protected $fillable = ['nome', 'preco'];

    public function variacoes()
    {
        return $this->hasMany(\App\Models\Variacao::class);
    }

}
