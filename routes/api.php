<?php

use App\Http\Controllers\WebhookController;

#webhook
Route::post('/webhook/pedido', [WebhookController::class, 'atualizarStatus']);
