<?php

/**
 * API - Sobre
 */
# Recupera o Sobre
$app->post('/sobre/getAll', function() use ($app) {
    (new \controllers\Sobre($app))->getAll();
    $app->response->setStatus(200);
});
