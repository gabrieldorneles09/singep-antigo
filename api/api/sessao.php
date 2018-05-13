<?php

/**
 * API - Sessão
 */
# Recupera todos as presenças
$app->post('/sessao/getAll', function() use ($app) {
    (new \controllers\Sessao($app))->getAll();
    $app->response->setStatus(200);
});
# Busca participante pelo ID
$app->post('/sessao/getCodigo', function() use ($app) {
    (new \controllers\Sessao($app))->getCodigo();
    $app->response->setStatus(200);
});
# Registra uma presença
$app->put('/sessao/setSessao', function() use ($app) {
    (new \controllers\Sessao($app))->setSessao();
    $app->response->setStatus(200);
});
