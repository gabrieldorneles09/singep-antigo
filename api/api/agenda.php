<?php

/**
 * API - Agenda
 */
# Realiza o agendamento de um artigo para visitação
$app->put('/agenda/setAgendar', function() use ($app) {
    (new \controllers\Agenda($app))->setAgendar();
    $app->response->setStatus(200);
});
# Realiza o agendamento de um artigo para visitação
$app->delete('/agenda/setRemover', function() use ($app) {
    (new \controllers\Agenda($app))->setRemover();
    $app->response->setStatus(200);
});
# Lista todos os artigos agendados
$app->post('/agenda/getAll', function() use ($app) {
    (new \controllers\Agenda($app))->getAll();
    $app->response->setStatus(200);
});
