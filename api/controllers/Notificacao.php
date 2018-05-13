<?php

namespace controllers {

    class Notificacao {

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
         *  @api {put} /api/notificacao/setEnviar Enviar
         *  @apiVersion 0.1.0
         *  @apiName setEnviar
         *  @apiGroup Notificacao
         *  @apiDescription Registra uma nova notificação a ser lida pelo cliente
         *  @apiParam (Parâmetro) {string} Token Token de acesso
         *  @apiParam (Parâmetro) {string} texto Texto da notificação
         *  @apiParam (Parâmetro) {int} tipo Geral (0) ou Individual (1)
         *  @apiParam (Parâmetro) {int} [codigo_participante] Código do participante quando individual
         * 
         *  @apiParamExample {json} Geral:
         *  { 
         *      "token":"9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "texto": "Confira os novos artigos aprovados....",
         *      "tipo": 0
         *  }
         * 
         *  @apiParamExample {json} Individual:
         *  { 
         *      "token":"9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "texto": "Confira os novos artigos aprovados....",
         *      "tipo": 1,
         *      "codigo_participante": 48
         *  }
         *  @apiSuccess {JSON} object Mensagem de sucesso
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "Notificação inserida com sucesso"
         *  }
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function setEnviar() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            # Monta um array com os parâmetros do envio
            $valores = array();
            foreach ($dados as $key => $value) {
                if ($key != 'token') {
                    $valores[$key] = $value;
                }
            }
            
            # Insere a notificação na tabela notificação
            $sql = "INSERT INTO notificacao (texto, url, tipo) "
                    . "VALUES (:texto, :url, :tipo)";
            $sth = $this->PDO->prepare($sql);
            $sth->bindValue(':texto', $valores['texto']);
            $sth->bindValue(':url', $valores['url']);
            $sth->bindValue(':tipo', $valores['tipo']);
            $sth->execute();
            $codigo_notificacao = $this->PDO->lastInsertId();


            # Verifica o tipo de notificação e insere na tabela notificações
            if ($valores['tipo'] == "1") { // direcionado à um participante
                $sql = "INSERT INTO notificacoes (codigo_notificacao, codigo_participante) "
                        . "VALUES (:codigo_notificacao, :codigo_participante)";
                $sth = $this->PDO->prepare($sql);

                $sth->bindValue(':codigo_notificacao', $codigo_notificacao);
                $sth->bindValue(':codigo_participante', $valores['codigo_participante']);
                $sth->execute();
            } else {

                $sql = "SELECT codigo_participante FROM participante";
                $sth = $this->PDO->prepare($sql);
                $sth->execute();
                $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

                foreach ($result as $valor) {
                    $sql = "INSERT INTO notificacoes (codigo_notificacao, codigo_participante) "
                            . "VALUES (:codigo_notificacao, :codigo_participante)";
                    $sth = $this->PDO->prepare($sql);

                    $sth->bindValue(':codigo_notificacao', $codigo_notificacao);
                    $sth->bindValue(':codigo_participante', $valor['codigo_participante']);
                    $sth->execute();
                }
            }
            $this->PDO = NULL;
            unset($this->PDO);
            $app->render('default.php', ["data" => json_decode('{"retorno": "Notificação enviada com sucesso!"}')], 200);
        }

        /**
         *  @api {post} /api/notificacao/getAll Todas
         *  @apiVersion 0.1.0
         *  @apiName getAll
         *  @apiGroup Notificacao
         *  @apiDescription Recupera todas as notificações - lidas e não lidas
         *  @apiParam (Parâmetro) {string} Token Token de acesso
         * 
         *  @apiParamExample {json} Geral:
         *  { 
         *      "token":"9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         * 
         *  @apiSuccess {JSON} object Mensagem de sucesso
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_notificacao": 2
         *          "texto": "Mensagem INDIVIDUAL"
         *          "data_envio": "13/07/2016"
         *          "data_leitura": null
         *      },
         *      {
         *          "codigo_notificacao": 1
         *          "texto": "Mensagem GERAL"
         *          "data_envio": "13/07/2016"
         *          "data_leitura": "14/07/2016"
         *      }
         *  ]
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getAll() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            # Recupera o código do participante
            $sql = "SELECT codigo_participante FROM participante WHERE token = :token";
            $sth = $this->PDO->prepare($sql);
            foreach ($dados as $key => $value) {
                if ($key == 'token') {
                    $sth->bindValue(':token', $value);
                }
            }
            $sth->execute();
            $result = $sth->fetch(\PDO::FETCH_ASSOC);
            $codigo_participante = $result['codigo_participante'];

            # Recupera as notificações do participante
            $sql = "SELECT "
                    . "notificacao.codigo_notificacao, notificacao.texto, notificacao.url, "
                    . "date_format(notificacoes.data_envio, '%d/%m/%Y') AS data_envio, "
                    . "date_format(notificacoes.data_leitura, '%d/%m/%Y') AS data_leitura "
                    . "FROM notificacao "
                    . "INNER JOIN notificacoes "
                    . "ON notificacao.codigo_notificacao = notificacoes.codigo_notificacao "
                    . "WHERE notificacoes.codigo_participante = :codigo_participante "
                    . "ORDER BY notificacoes.data_envio DESC";

            //echo $codigo_participante;exit;
            $sth = $this->PDO->prepare($sql);
            $sth->bindValue(':codigo_participante', $codigo_participante);

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
         *  @api {post} /api/notificacao/getNovas Novas
         *  @apiVersion 0.1.0
         *  @apiName getNovas
         *  @apiGroup Notificacao
         *  @apiDescription Recupera todas as notificações novas
         *  @apiParam (Parâmetro) {string} Token Token de acesso
         * 
         *  @apiParamExample {json} Geral:
         *  { 
         *      "token":"9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         * 
         *  @apiSuccess {JSON} object Mensagem de sucesso
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_notificacao": 2
         *          "texto": "Mensagem INDIVIDUAL"
         *          "data_envio": "13/07/2016"
         *          "data_leitura": null
         *      }
         *  ]
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getNovas() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            # Recupera o código do participante
            $sql = "SELECT codigo_participante FROM participante WHERE token = :token";
            $sth = $this->PDO->prepare($sql);
            foreach ($dados as $key => $value) {
                if ($key == 'token') {
                    $sth->bindValue(':token', $value);
                }
            }
            $sth->execute();
            $result = $sth->fetch(\PDO::FETCH_ASSOC);
            $codigo_participante = $result['codigo_participante'];

            # Recupera as notificações do participante
            $sql = "SELECT "
                    . "notificacoes.id_notificacao AS codigo_notificacao, notificacao.texto, notificacao.url, "
                    . "date_format(notificacoes.data_envio, '%d/%m/%Y') AS data_envio, "
                    . "date_format(notificacoes.data_leitura, '%d/%m/%Y') AS data_leitura "
                    . "FROM notificacao "
                    . "INNER JOIN notificacoes "
                    . "ON notificacao.codigo_notificacao = notificacoes.codigo_notificacao "
                    . "WHERE notificacoes.codigo_participante = :codigo_participante "
                    . "AND notificacoes.data_leitura IS NULL "
                    . "AND baixada != 1 "
                    . "ORDER BY notificacoes.data_envio";

            $sth = $this->PDO->prepare($sql);
            $sth->bindValue(':codigo_participante', $codigo_participante);

            try {
                $sth->execute();
                $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

                # Marca como baixadas
                foreach ($result as $valor) {
                    $sql = "UPDATE notificacoes "
                            . "SET baixada = 1 "
                            . "WHERE id_notificacao = :codigo_notificacao";
                    $sth = $this->PDO->prepare($sql);
                    $sth->bindValue(':codigo_notificacao', $valor['codigo_notificacao']);
                    $sth->execute();
                }

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
         *  @api {put} /api/notificacao/setLida Lida
         *  @apiVersion 0.1.0
         *  @apiName setLida
         *  @apiGroup Notificacao
         *  @apiDescription Marca uma notificação como lida
         *  @apiParam (Parâmetro) {string} Token Token de acesso
         *  @apiParam (Parâmetro) {int} codigo_notificacao Código da notificação
         *  @apiParam (Parâmetro) {int} codigo_participante Código do participante
         * 
         *  @apiParamExample {json} Geral:
         *  { 
         *      "token":"9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "codigo_notificacao": 3,
         *      "codigo_participante": 48
         *  }
         * 
         *  @apiSuccess {JSON} object Mensagem de sucesso
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "ok"
         *  }
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function setLida() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $valores = array();
            foreach ($dados as $key => $valor) {
                $valores[$key] = $valor;
            }

            # Marca a notificação como lida
            $sql = "UPDATE notificacoes SET data_leitura = '" . date("Y-m-d H:i:s") . "' "
                    . "WHERE notificacoes.codigo_participante = :codigo_participante "
                    . "AND notificacoes.id_notificacao = :id_notificacao";

            $sth = $this->PDO->prepare($sql);
            $sth->bindValue(':codigo_participante', $valores['codigo_participante']);
            $sth->bindValue(':id_notificacao', $valores['codigo_notificacao']);

            try {
                $sth->execute();

                $this->PDO = NULL;
                unset($this->PDO);

                if ($sth->RowCount() < 1) {
                    $app->render('default.php', ["data" => json_decode($this->warning)], 200);
                } else {
                    $app->render('default.php', ["data" => json_decode('{"retorno": "ok"}')], 200);
                }
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

    }

}

