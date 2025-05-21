<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'estoques';

    protected $primaryKey = 'id';

    protected $fillable = ['produto_id', 'variacao_id', 'quantidade'];
}
