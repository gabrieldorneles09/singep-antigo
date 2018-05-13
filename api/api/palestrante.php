<?php

/**
 * API - Palestrante
 */
# Recupera todos os palestrantes
$app->post('/palestrante/getAll', function() use ($app) {
    (new \controllers\Palestrante($app))->getAll();
    $app->response->setStatus(200);
});

# Recupera um palestrante específico
$app->post('/palestrante/getCodigo', function() use ($app) {
    (new \controllers\Palestrante($app))->getCodigo();
    $app->response->setStatus(200);
});


