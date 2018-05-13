<?php

/**
 * API - Chat
 */
# Realiza o 
$app->post('/autor/getAll', function() use ($app) {
    (new \controllers\Autor($app))->getAll();
    $app->response->setStatus(200);
});
# Busca autor pelo ID
$app->post('/autor/getCodigo', function() use ($app) {
    (new \controllers\Autor($app))->getCodigo();
    $app->response->setStatus(200);
});
# Busca autor pelo Nome (like)
$app->post('/autor/getNome', function() use ($app) {
    (new \controllers\Autor($app))->getNome();
    $app->response->setStatus(200);
});
# Busca autor pela Filiação (Universidade)
$app->post('/autor/getFiliacao', function() use ($app) {
    (new \controllers\Autor($app))->getFiliacao();
    $app->response->setStatus(200);
});
