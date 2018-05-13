<?php

/**
 * API - Autenticação
 */
# Login do participante
$app->post('/api/getLogin', function() use ($app) {
    (new \controllers\Login($app))->getLogin();
    $app->response->setStatus(200);
});
$app->post('/api/getLogout', function() use ($app) {
    (new \controllers\Login($app))->getLogout();
    $app->response->setStatus(200);
});
