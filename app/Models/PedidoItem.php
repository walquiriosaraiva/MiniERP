<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $table = 'pedido_itens';

    protected $primaryKey = 'id';

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'variacao_id',
        'quantidade',
        'preco_unitario',
        'total',
    ];

    public function produto()
    {
        return $this->belongsTo(\App\Models\Produto::class);
    }

    public function variacao()
    {
        return $this->belongsTo(\App\Models\Variacao::class);
    }

}
