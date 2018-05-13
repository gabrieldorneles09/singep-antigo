<?php

namespace controllers {

    class Programacao {

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
         *  @api {post} /api/programacao/getAll Completa
         *  @apiDescription Toda requisição deve conter o token do usuário no primeiro argumento do JSON
         *  @apiVersion 0.1.0
         *  @apiName getAll
         *  @apiGroup Programacao
         *  @apiDescription Utilizado para recuperação a programação do evento (tela inicial do APP).
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         * 
         *  @apiSuccess {JSON} object Array com toda a programação
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_programacao": 1,
         *          "data": "21/11/2016",
         *          "hora": "16:00 as 19:30",
         *          "titulo": "Workshop - Gamificação",
         *          "conteudo": "Palestrante: Prof. Dr. José da Silva (Diretor de Avaliação da CAPES). Palestrante: Prof. Dr. José da Silva (Diretor de Avaliação da CAPES)."
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

            $sql = "SELECT * FROM programacao "
                    . "ORDER BY codigo_programacao ASC";

            $sth = $this->PDO->prepare($sql);

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
         *  @api {post} /api/programacao/getPrimeiroDia Primeiro Dia
         *  @apiDescription Toda requisição deve conter o token do usuário no primeiro argumento do JSON
         *  @apiVersion 0.1.0
         *  @apiName getPrimeiroDia
         *  @apiGroup Programacao
         *  @apiDescription Utilizado para recuperação a programação do evento Primeiro Dia (tela inicial do APP).
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         * 
         *  @apiSuccess {JSON} object Array com toda a programação
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_programacao": 1,
         *          "data": "21/11/2016",
         *          "hora": "16:00 as 19:30",
         *          "titulo": "Workshop - Gamificação",
         *          "conteudo": "Palestrante: Prof. Dr. José da Silva (Diretor de Avaliação da CAPES). Palestrante: Prof. Dr. José da Silva (Diretor de Avaliação da CAPES)."
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
        public function getPrimeiroDia() {
            global $app;

            $sql = "SELECT * FROM programacao WHERE data = '13/11/2017' ";

            $sth = $this->PDO->prepare($sql);

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
         *  @api {post} /api/programacao/getSegundoDia Segundo Dia
         *  @apiDescription Toda requisição deve conter o token do usuário no primeiro argumento do JSON
         *  @apiVersion 0.1.0
         *  @apiName getSegundoDia
         *  @apiGroup Programacao
         *  @apiDescription Utilizado para recuperação a programação do evento Segundo Dia (tela inicial do APP).
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         * 
         *  @apiSuccess {JSON} object Array com toda a programação
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_programacao": 1,
         *          "data": "22/11/2016",
         *          "hora": "16:00 as 19:30",
         *          "titulo": "Workshop - Gamificação",
         *          "conteudo": "Palestrante: Prof. Dr. José da Silva (Diretor de Avaliação da CAPES). Palestrante: Prof. Dr. José da Silva (Diretor de Avaliação da CAPES)."
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
        public function getSegundoDia() {
            global $app;

            $sql = "SELECT * FROM programacao WHERE data = '14/11/2017' ";

            $sth = $this->PDO->prepare($sql);

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

    }

}
