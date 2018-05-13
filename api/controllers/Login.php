<?php

namespace controllers {

    class Login {

        //Atributo para banco de dados
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
         *  @api {post} /api/api/getLogin Login
         *  @apiVersion 0.1.0
         *  @apiName getLogin
         *  @apiGroup Acesso
         *  @apiParam (Parâmetro) {string} login Flag de acesso da API
         *  @apiParam (Parâmetro) {string} email E-mail do participante
         *  @apiParam (Parâmetro) {string} documento Documento do participante
         *  @apiDescription Retorna um TOKEN para ser utilizado em todas as requisições da API
         * 
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "login": "true",
         *      "email": "autor@instituicao.com",
         *      "documento": "123456789"
         *  }
         * 
         *  @apiSuccess {JSON} object Retorna o Token, código e nome do participante
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  {
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "codigo_participante": 457,
         *      "nome": "Pedro Matias",
         *  }
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getLogin() {
            
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $sql = "SELECT token, codigo_participante, nome, adm "
                    . "FROM participante "
                    . "WHERE email = :email AND documento = :documento";
            
            $sth = $this->PDO->prepare($sql);
            foreach ($dados as $key => $value) {
                if ($key != "login") {
                    $sth->bindValue("$key", $value);
                }
            }

            try {
                $sth->execute();
                $result = $sth->fetch(\PDO::FETCH_ASSOC);

                $this->PDO = NULL;
                unset($this->PDO);

                if ($sth->RowCount() != 1) {
                    $app->render('default.php', ["data" => json_decode($this->warning)], 200);
                } else {
                    $app->render('default.php', ["data" => $result], 200);
                }
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

        /**
         *  @api {post} /api/api/getLogout Logout
         *  @apiVersion 0.1.0
         *  @apiName getLogout
         *  @apiGroup Acesso
         *  @apiParam (Parâmetro) {string} login False
         *  @apiParam (Parâmetro) {string} token Token de acesso da API
         *  @apiDescription Retorna uma mensagem de desconexão
         * 
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "login": "false",
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         * 
         *  @apiSuccess {JSON} object Retorna a mensagem de desconexão
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "Desconectado com Sucesso"
         *  }
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getLogout() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $sql = "SELECT token "
                    . "FROM participante "
                    . "WHERE token = :token";

            $sth = $this->PDO->prepare($sql);
            foreach ($dados as $key => $value) {
                if ($key != "login") {
                    $sth->bindValue("$key", $value);
                }
            }

            try {
                $sth->execute();
                $result = $sth->fetch(\PDO::FETCH_ASSOC);

                $this->PDO = NULL;
                unset($this->PDO);

                if ($sth->RowCount() != 1) {
                    $app->render('default.php', ["data" => json_decode($this->warning)], 200);
                } else {
                    $app->render('default.php', ["data" => json_decode('{"retorno": "Desconectado com Sucesso"}')], 200);
                }
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

    }

}
