<?php

/**
 * API - Programação
 */
# Recupera toda a programacao
$app->post('/programacao/getAll', function() use ($app) {
    (new \controllers\Programacao($app))->getAll();
    $app->response->setStatus(200);
});

# Recupera programacao do primeiro dia
$app->post('/programacao/getPrimeiroDia', function() use ($app) {
    (new \controllers\Programacao($app))->getPrimeiroDia();
    $app->response->setStatus(200);
});

# Recupera programacao do segundo dia
$app->post('/programacao/getSegundoDia', function() use ($app) {
    (new \controllers\Programacao($app))->getSegundoDia();
    $app->response->setStatus(200);
});


