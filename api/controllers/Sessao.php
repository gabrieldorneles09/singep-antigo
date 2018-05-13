<?php

namespace controllers {

    class Sessao {

        private $PDO;
        private $warning = '{"retorno":"null"}';

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
         *  @api {post} /api/sessao/getAll Todas
         *  @apiVersion 0.1.0
         *  @apiName getAll
         *  @apiGroup Presenca Sessao
         *  @apiDescription Recupera todas as presenças confirmadas em todas as salas de todos os participantes
         *  @apiParam (Parâmetro) {string} Token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token":"9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         * 
         *  @apiSuccess {JSON} object Array contendo o registro das presenças em todas as salas ordenados por sala
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_sessao": 1,
         *          "codigo_participante": 1,
         *          "sala": 502,
         *          "data_hora": "2016-11-28 14:55:28"
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
                    "SELECT * "
                    . "FROM sessao "
                    . "ORDER BY sala ASC, data_hora ASC");

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
         *  @api {post} /api/sessao/getCodigo Pesquisar
         *  @apiVersion 0.1.0
         *  @apiName getCodigo
         *  @apiGroup Presenca Sessao
         *  @apiDescription Realiza a busca de todas as presenças de um participante em todas as sessões
         *  @apiParam (Parâmetro) {string} Token Token de acesso
         *  @apiParam (Parâmetro) {int} codigo_participante Código do participante
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "codigo_participante": 1
         *  }
         *
         *  @apiSuccess {JSON} object Retorna um Array com os registro das presenças do participante
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_sessao": 1,
         *          "codigo_participante": 1,
         *          "sala": 502,
         *          "data_hora": "2016-11-28 14:55:28"
         *      }
         *  ]
         * 
         * @apiErrorExample {json} Retorno-Vazio:
         *     HTTP/1.1 200 OK
         *     {
         *       "retorno": "null"
         *     }
         * 
         */
        public function getCodigo() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $sql = "SELECT * FROM sessao "
                    . "WHERE codigo_participante = :codigo_participante "
                    . "ORDER BY data_hora DESC";

            $sth = $this->PDO->prepare($sql);
            foreach ($dados as $key => $value) {
                $sth->bindValue(':codigo_participante', $value);
            }

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
         *  @api {put} /api/sessao/setSessao Registrar
         *  @apiVersion 0.1.0
         *  @apiName setSessao
         *  @apiGroup Presenca Sessao
         *  @apiDescription Registra a presença de um participante na sessão lida pelo QRCode
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {int} sala Número da sala onde ocorrerá a apresentação. Este valor deverá ser obtido por meio da leitura do QRCode fixado na porta das salas
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "sala": 506
         *  }
         * 
         *  @apiSuccess {JSON} object Registro da presença
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  {
         *      "codigo_sessao": 1,
         *      "codigo_participante": 1,
         *      "sala": 502,
         *      "data_hora": "2016-11-28 14:55:28",
         *  }
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function setSessao() {
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

            # Insere o registro da presença
            $sql = "INSERT INTO sessao (codigo_participante, sala) "
                    . "VALUES "
                    . "(:codigo_participante, :sala)";

            $sth = $this->PDO->prepare($sql);

            $sth->bindValue("codigo_participante", $codigo_participante);
            $sth->bindValue("sala", $value);

            try {
                if ((int) $value != 0) {
                    $sth->execute();
                    $sql = "SELECT * "
                            . "FROM sessao "
                            . "WHERE codigo_sessao = " . $this->PDO->lastInsertId();
                    $sth = $this->PDO->prepare($sql);

                    $sth->execute();
                    $result = $sth->fetch(\PDO::FETCH_ASSOC);
                    $this->PDO = NULL;
                    unset($this->PDO);
                    $app->render('default.php', ["data" => $result], 200);
                } else {
                    $app->render('default.php', ["data" => json_decode($this->warning)], 200);
                }
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

    }

}
