<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nome_cliente',
        'email_cliente',
        'cep',
        'subtotal',
        'frete',
        'total',
        'status',
    ];

    public function itens()
    {
        return $this->hasMany(\App\Models\PedidoItem::class);
    }

}
