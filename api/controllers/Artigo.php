<?php

namespace controllers {

    class Artigo {

        private $PDO;
        private $warning = '{"retorno": "null"}';

        function __construct() {
            $this->PDO = new \PDO(
                    DB_TYPE . ":host=" .
                    HOSTNAME . ";dbname=" .
                    DB_NAME, DB_USER, DB_PASSWORD
            );
            $this->PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->PDO->setAttribute(\PDO::ATTR_PERSISTENT, FALSE);
            $this->PDO->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf-8");
            $this->PDO->exec("set names utf8");
        }

        /**
         *  @api {post} /api/artigo/getAll Todos
         *  @apiVersion 0.1.0
         *  @apiName getAll
         *  @apiGroup Artigo
         *  @apiDescription Recupera todos os artigos cadastrados
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token":"9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         *
         *  @apiSuccess {JSON} object Retorna um Array com todos o artigos cadastrados.
         *  @apiSuccess {int} codigo_artigo Artigo completo em PDF para download no diretório (/download/codigo_artigo)
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_artigo": "527",
         *          "titulo": "2015 INTERNATIONAL MODULE ...",
         *          "data": "08/11/2015",
         *          "horario": "17:30 as 18:30",
         *          "local": "HALL",
         *          "tipo_trabalho": "Pôster"
         *      }
         *  ]
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getAll() {
            global $app;
            $sth = $this->PDO->prepare(
                    "SELECT codigo_artigo, titulo, data, horario, local, tipo_trabalho "
                    . "FROM artigo WHERE inativo = 0 "
                    . "ORDER BY titulo ASC");

            try {
                $sth->execute();
                $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

                $this->PDO = NULL;
                unset($this->PDO);

                $app->render('default.php', ["data" => $result], 200);
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

        /**
         *  @api {post} /api/artigo/getCodigo Específico
         *  @apiVersion 0.1.0
         *  @apiName getCodigo
         *  @apiGroup Artigo
         *  @apiDescription Realiza a busca específica de um artigo pelo seu código
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {int} codigo_artigo Código do artigo
         *  @apiParamExample {json} Exemplo de uso:

         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "codigo_artigo": 1
         *  }
         *
         *  @apiSuccess {JSON} object Retorna um artigo específico
         *  @apiSuccess {int} codigo_artigo Artigo completo em PDF para download no diretório (/download/codigo_artigo)
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  {
         *      "codigo_artigo": 1,
         *      "data": "09/11/2015",
         *      "horario":"15:00 às 16:00",
         *      "local": 515,
         *      "tipo_trabalho": "Relato|Artigo|Pôster",
         *      "area": "Inovação",
         *      "tema": "Inovação e Marketing",
         *      "titulo": "Título do artigo",
         *      "resumo": "O estudo buscou compreender...",
         *      "inativo": "0"
         *  }
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getCodigo() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $sql = "SELECT * FROM artigo WHERE inativo = 0 "
                    . "AND codigo_artigo = :codigo_artigo";

            $sth = $this->PDO->prepare($sql);
            foreach ($dados as $key => $value) {
                $sth->bindValue(':codigo_artigo', $value);
            }

            try {
                $sth->execute();
                $result = $sth->fetch(\PDO::FETCH_ASSOC);

                $this->PDO = NULL;
                unset($this->PDO);

                if ($sth->RowCount() < 1) {
                    $app->render('default.php', ["data" => json_decode($this->warning)], 200);
                } else {
                    $app->render('default.php', ["data" => $result], 200);
                }
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

        /**
         *  @api {post} /api/artigo/getTitulo Título
         *  @apiVersion 0.1.0
         *  @apiName getTitulo
         *  @apiGroup Artigo
         *  @apiDescription Realiza a busca (LIKE) pelo campo título do artigo
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {string} titulo Retorna um Array com todos os títulos localizados com base na palavra pesquisada 
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "titulo": "inovação"
         *  }
         * 
         *  @apiSuccess {JSON} object Retorna os artigos que contém a palavra pesquisada
         *  @apiSuccess {int} codigo_artigo Artigo completo em PDF para download no diretório (/download/codigo_artigo)
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_artigo": "527",
         *          "titulo": "2015 INTERNATIONAL MODULE ...",
         *          "data": "08/11/2015",
         *          "horario": "17:30 as 18:30",
         *          "local": "HALL",
         *          "tipo_trabalho": "Pôster"
         *      }
         *  ]
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getTitulo() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $sql = "SELECT codigo_artigo, titulo, data, horario, local, tipo_trabalho "
                    . "FROM artigo "
                    . "WHERE titulo "
                    . "LIKE :query AND inativo = 0 "
                    . "ORDER BY titulo ASC";

            $sth = $this->PDO->prepare($sql);

            foreach ($dados as $key => $value) {
                $query = "%" . $value . "%";
            }
            $sth->bindValue(':query', $query);

            try {
                $sth->execute();
                $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

                $this->PDO = NULL;
                unset($this->PDO);

                if ($sth->RowCount() < 1) {
                    $app->render('default.php', ["data" => json_decode($this->warning)], 200);
                } else {
                    $app->render('default.php', ["data" => $result], 200);
                }
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

        /**
         *  @api {post} /api/artigo/getResumo Resumo
         *  @apiVersion 0.1.0
         *  @apiName getResumo
         *  @apiGroup Artigo
         *  @apiDescription Realiza a busca (LIKE) pelo campo resumo do artigo
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {string} resumo Valor procurado
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "resumo": "inovação"
         *  }
         *  @apiSuccess {JSON} object Array com os resumos encontrados para a palavra chave
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_artigo": 1,
         *          "titulo": "Título do artigo",
         *          "resumo": "O estudo buscou compreender..."
         *      }
         *  ]
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getResumo() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $sql = "SELECT codigo_artigo, titulo, resumo "
                    . "FROM artigo "
                    . "WHERE resumo "
                    . "LIKE :query AND inativo = 0 "
                    . "ORDER BY titulo ASC";

            $sth = $this->PDO->prepare($sql);

            foreach ($dados as $key => $value) {
                $query = "%" . $value . "%";
            }
            $sth->bindValue(':query', $query);

            try {
                $sth->execute();
                $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

                $this->PDO = NULL;
                unset($this->PDO);

                if ($sth->RowCount() < 1) {
                    $app->render('default.php', ["data" => json_decode($this->warning)], 200);
                } else {
                    $app->render('default.php', ["data" => $result], 200);
                }
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

        /**
         *  @api {post} /api/artigo/getAreaTema Pesquisa Area=>Tema
         *  @apiVersion 0.1.0
         *  @apiName getAreaTema
         *  @apiGroup Artigo
         *  @apiDescription Realiza a busca dos artigos de acordo com a área e o tema selecionado
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {string} area Área do artigo
         *  @apiParam (Parâmetro) {string} tema Tema relacionado a área
         *  @apiParam (Parâmetro) {string} [data=null] Data da apresentação
         *  @apiParam (Parâmetro) {string} [horario=null] Horário da apresentação
         *  @apiParamExample {json} Padrão:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "area": "Inovação",
         *      "tema": "Inovação e Marketing",
         *      "data": "null",
         *      "horario": "null"
         *  }
         * 
         *  @apiParamExample {json} Filtro Completo:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "area": "Inovação",
         *      "tema": "Inovação e Marketing",
         *      "data": "09/11/2015",
         *      "horario": "14:00 as 15:30"
         *  }
         * 
         *  @apiSuccess {JSON} object Retorna um array com todos os artigos encontrados
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_artigo": "149"
         *          "data": "09/11/2015"
         *          "horario": "14:00 as 15:30"
         *          "area": "Inovação"
         *          "tema": "Inovação e Marketing"
         *          "local": "516"
         *          "tipo_trabalho": "Artigo"
         *          "titulo": "UMA ANÁLISE DA GESTÃO FINANCEIRA PESSOAL DOS CONSUMIDORES..."
         *      }
         *  ]
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getAreaTema() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);
            $valores = array();

            foreach ($dados as $key => $value) {
                $valores[$key] = $value;
            }
            $sql = NULL;
            $optionalFields = 0;
            if (($valores['data'] == 'null') && ($valores['horario'] == 'null')) {
                $sql = "SELECT artigo.codigo_artigo, artigo.data, artigo.horario, 
                        artigo.area, artigo.tema, artigo.local, artigo.tipo_trabalho, artigo.titulo, artigo.inativo 
                        
                        FROM (artigo INNER JOIN artigo_autor ON artigo.codigo_artigo = artigo_autor.codigo_artigo) 
                        INNER JOIN autor ON artigo_autor.codigo_autor = autor.codigo_autor
                        WHERE (area = :artigo_area and tema = :artigo_tema and inativo = 0) 
                        GROUP BY artigo.codigo_artigo 
                        ORDER BY artigo.data ASC, artigo.horario, artigo.titulo ASC;";
            } else if (($valores['data'] != 'null') && ($valores['horario'] == 'null')) {
                $sql = "SELECT artigo.codigo_artigo, artigo.data, artigo.horario, 
                        artigo.area, artigo.tema, artigo.local, artigo.tipo_trabalho, artigo.titulo, artigo.inativo  
                        
                        FROM (artigo INNER JOIN artigo_autor ON artigo.codigo_artigo = artigo_autor.codigo_artigo) 
                        INNER JOIN autor ON artigo_autor.codigo_autor = autor.codigo_autor
                        WHERE (area = :artigo_area and tema = :artigo_tema and data = :artigo_data and inativo = 0) 
                        GROUP BY artigo.codigo_artigo 
                        ORDER BY  artigo.titulo, artigo.data ASC, artigo.horario ASC;";
                $optionalFields = 1;
            } else if (($valores['data'] == 'null') && ($valores['horario'] != 'null')) {
                $sql = "SELECT artigo.codigo_artigo, artigo.data, artigo.horario, 
                        artigo.area, artigo.tema, artigo.local, artigo.tipo_trabalho, artigo.titulo, artigo.inativo 
                        
                        FROM (artigo INNER JOIN artigo_autor ON artigo.codigo_artigo = artigo_autor.codigo_artigo) 
                        INNER JOIN autor ON artigo_autor.codigo_autor = autor.codigo_autor
                        WHERE (area = :artigo_area and tema = :artigo_tema and horario = :artigo_horario and inativo = 0) 
                        GROUP BY artigo.codigo_artigo 
                        ORDER BY  artigo.titulo, artigo.data ASC, artigo.horario ASC;";
                $optionalFields = 2;
            } else if (($valores['data'] != 'null') && ($valores['horario'] != 'null')) {
                $sql = "SELECT artigo.codigo_artigo, artigo.data, artigo.horario, 
                        artigo.area, artigo.tema, artigo.local, artigo.tipo_trabalho, artigo.titulo, artigo.inativo 
                        
                        FROM (artigo INNER JOIN artigo_autor ON artigo.codigo_artigo = artigo_autor.codigo_artigo) 
                        INNER JOIN autor ON artigo_autor.codigo_autor = autor.codigo_autor
                        WHERE (area = :artigo_area and tema = :artigo_tema and data = :artigo_data and horario = :artigo_horario and inativo = 0) 
                        GROUP BY artigo.codigo_artigo 
                        ORDER BY  artigo.titulo, artigo.data ASC, artigo.horario ASC;";
                $optionalFields = 3;
            }

            # Montagem da query
            $sth = $this->PDO->prepare($sql);
            $sth->bindValue(':artigo_area', $valores['area']);
            $sth->bindValue(':artigo_tema', $valores['tema']);

            # Prepara os campos opcionais
            if ($optionalFields == 1) {
                $sth->bindValue(":artigo_data", $valores['data']);
            } else if ($optionalFields == 2) {
                $sth->bindValue(":artigo_horario", $valores['horario']);
            } else if ($optionalFields == 3) {
                $sth->bindValue(":artigo_data", $valores['data']);
                $sth->bindValue(":artigo_horario", $valores['horario']);
            }
            # fim da montagem da query

            try {
                $sth->execute();
                $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

                $this->PDO = NULL;
                unset($this->PDO);

                if ($sth->rowCount() < 1) {
                    $app->render('default.php', ["data" => json_decode($this->warning)], 200);
                } else {
                    $app->render('default.php', ["data" => $result], 200);
                }
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

        # Autor Artigo
        /**
         *  @api {post} /api/artigo/getArtigos Artigos=>Autor
         *  @apiVersion 0.1.0
         *  @apiName getArtigos
         *  @apiGroup Artigo
         *  @apiDescription Realiza a busca dos artigos onde o autor participa
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {int} codigo_autor Código do autor
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "codigo_autor": 1
         *  }
         * 
         *  @apiSuccess {JSON} object Retorna um array com todos os artigos de um determinado autor
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_artigo": 78,
         *          "data": "09/11/2015",
         *          "horario": "14:00 as 15:30",
         *          "local": 508,
         *          "tipo_trabalho": "Relato",
         *          "titulo": "UTILIZAÇÃO DE PRÁTICAS ÁGEIS EM GRANDES PROJETOS DE DESENVOLVIMENTO..."
         *      }
         *  ]
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */

        public function getArtigos() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $sql = "SELECT artigo.codigo_artigo, artigo.data, artigo.horario, 
                    artigo.area, artigo.tema, artigo.local, artigo.tipo_trabalho, artigo.titulo, artigo.inativo 
                    
                    FROM (artigo INNER JOIN artigo_autor ON artigo.codigo_artigo = artigo_autor.codigo_artigo) 
                    INNER JOIN autor ON artigo_autor.codigo_autor = autor.codigo_autor
                    WHERE autor.codigo_autor = :codigo_autor and artigo.inativo = 0";

            $sth = $this->PDO->prepare($sql);
            foreach ($dados as $key => $value) {
                $sth->bindValue(':codigo_autor', $value);
            }

            try {
                $sth->execute();
                $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

                $this->PDO = NULL;
                unset($this->PDO);

                if ($sth->rowCount() < 1) {
                    $app->render('default.php', ["data" => json_decode($this->warning)], 200);
                } else {
                    $app->render('default.php', ["data" => $result], 200);
                }
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

        /**
         *  @api {post} /api/artigo/getArtigoDetalhe Detalhe=>Artigo
         *  @apiVersion 0.1.0
         *  @apiName getArtigoDetalhe
         *  @apiGroup Artigo
         *  @apiDescription Realiza a busca do artigo especificado, incluindo o resumo
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {int} codigo_artigo Código do artigo
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "codigo_artigo": 1
         *  }
         * 
         *  @apiSuccess {JSON} object Retorna um Array com o artigo e os autores participantes
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "detalhe_artigo": 
         *          {
         *              "codigo_artigo": 542,
         *              "titulo": "APLICAÇÃO DA TEORIA DE OPÇÕES REAIS EM PROJETO DE GERAÇÃO EÓLICA...",
         *              "data": "09/11/2015",
         *              "horario": "14:00 as 15:30",
         *              "local": 511,
         *              "tipo_trabalho": "Artigo",
         *              "resumo": "Este artigo apresenta critérios de precificação de opções reais em..."
         *              "autores": 
         *              [
         *                  {
         *                      "nome": "Haroldo G. Brasil",
         *                      "filiacao": "IBMEC - MG"
         *                  }
         *              ]
         *          }
         *      }    
         *  ]
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getArtigoDetalhe() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $sql = "SELECT artigo.*, autor.*
                        FROM (artigo INNER JOIN artigo_autor ON artigo.codigo_artigo = artigo_autor.codigo_artigo) 
                        INNER JOIN autor ON artigo_autor.codigo_autor = autor.codigo_autor
                        WHERE artigo.codigo_artigo = :codigo_artigo";

            $sth = $this->PDO->prepare($sql);
            foreach ($dados as $key => $value) {
                $sth->bindValue(':codigo_artigo', $value);
            }
            $sth->execute();
            $resultX = $sth->fetchAll(\PDO::FETCH_ASSOC);

            $valor = array();
            $autores = array();

            try {
                foreach ($resultX as $autor) {
                    $autores[] = array(
                        "nome" => $autor['nome'],
                        "filiacao" => $autor['filiacao']
                    );
                }

                foreach ($resultX as $artigo) {
                    $valor = array(
                        "codigo_artigo" => $artigo['codigo_artigo'],
                        "titulo" => $artigo['titulo'],
                        "data" => $artigo['data'],
                        "horario" => $artigo['horario'],
                        "local" => $artigo['local'],
                        "area" => $artigo['area'],
                        "tema" => $artigo['tema'],
                        "tipo_trabalho" => $artigo['tipo_trabalho'],
                        "resumo" => $artigo['resumo'],
                        "autores" => $autores
                    );
                }
                $result['detalhe_artigo'][] = $valor;

                $this->PDO = NULL;
                unset($this->PDO);

                if ($sth->rowCount() < 1) {
                    $app->render('default.php', ["data" => json_decode($this->warning)], 200);
                } else {
                    $app->render('default.php', ["data" => $result], 200);
                }
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

    }

}
