<?php

/**
 * API - Notificação
 */
# Realiza o envio de uma notificação
$app->put('/notificacao/setEnviar', function() use ($app) {
    (new \controllers\Notificacao($app))->setEnviar();
    $app->response->setStatus(200);
});
# Recupera todas as notificações de um participante
$app->post('/notificacao/getAll', function() use ($app) {
    (new \controllers\Notificacao($app))->getAll();
    $app->response->setStatus(200);
});
# Recupera todas as notificações não lidas de um participante
$app->post('/notificacao/getNovas', function() use ($app) {
    (new \controllers\Notificacao($app))->getNovas();
    $app->response->setStatus(200);
});
# Marca uma notificação como lida
$app->put('/notificacao/setLida', function() use ($app) {
    (new \controllers\Notificacao($app))->setLida();
    $app->response->setStatus(200);
});
