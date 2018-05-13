<?php

/**
 * API - Artigos
 */
# Recupera todos os artigos
$app->post('/artigo/getAll', function() use ($app) {
    (new \controllers\Artigo($app))->getAll();
    $app->response->setStatus(200);
});
# Busca artigo pelo ID
$app->post('/artigo/getCodigo', function() use ($app) {
    (new \controllers\Artigo($app))->getCodigo();
    $app->response->setStatus(200);
});
# Busca artigo pelo Nome (like)
$app->post('/artigo/getTitulo', function() use ($app) {
    (new \controllers\Artigo($app))->getTitulo();
    $app->response->setStatus(200);
});
# Busca artigo pelo resumo
$app->post('/artigo/getResumo', function() use ($app) {
    (new \controllers\Artigo($app))->getResumo();
    $app->response->setStatus(200);
});
# Busca artigo pela área e tema
$app->post('/artigo/getAreaTema', function() use ($app) {
    (new \controllers\Artigo($app))->getAreaTema();
    $app->response->setStatus(200);
});
# Busca autor pela Filiação (Universidade)
$app->post('/artigo/getArtigos', function() use ($app) {
    (new \controllers\Artigo($app))->getArtigos();
    $app->response->setStatus(200);
});
# Busca autor pela Filiação (Universidade)
$app->post('/artigo/getArtigoDetalhe', function() use ($app) {
    (new \controllers\Artigo($app))->getArtigoDetalhe();
    $app->response->setStatus(200);
});
