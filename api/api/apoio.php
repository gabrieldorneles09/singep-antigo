<?php

/**
 * API - Apoio
 */
# Recupera todas as áreas
$app->post('/area/getAll', function() use ($app) {
    (new \controllers\Apoio($app))->getAreasAll();
    $app->response->setStatus(200);
});
# Busca área pelo código
$app->post('/area/getCodigo', function() use ($app) {
    (new \controllers\Apoio($app))->getAreaCodigo();
    $app->response->setStatus(200);
});
# Busca todos os temas
$app->post('/tema/getAll', function() use ($app) {
    (new \controllers\Apoio($app))->getTemaAll();
    $app->response->setStatus(200);
});
# Busca um tema pelo código
$app->post('/tema/getCodigo', function() use ($app) {
    (new \controllers\Apoio($app))->getTemaCodigo();
    $app->response->setStatus(200);
});
# Busca todas as áreas com os temas relacionados
$app->post('/area_tema/getAreaTemas', function() use ($app) {
    (new \controllers\Apoio($app))->getAreaTemas();
    $app->response->setStatus(200);
});
# Busca todas as datas com os horários disponíveis
$app->post('/data/getDataHorario', function() use ($app) {
    (new \controllers\Apoio($app))->getDataHorario();
    $app->response->setStatus(200);
});
