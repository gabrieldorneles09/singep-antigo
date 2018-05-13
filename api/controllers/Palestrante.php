<?php

namespace controllers {

    class Palestrante {

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
         *  @api {post} /api/palestrante/getAll Todos
         *  @apiDescription Toda requisição deve conter o token do usuário no primeiro argumento do JSON
         *  @apiVersion 0.1.0
         *  @apiName getAll
         *  @apiGroup Palestrante 
         *  @apiDescription Utilizado para recuperação de todos os palestrante cadastrados. O caminho da imagem é images/
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         * 
         *  @apiSuccess {JSON} object Array com todos os palestrantes cadastrados
         *  @apiSuccess {String} foto Nome do arquivo em (/fotos/)
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_palestrante": 1,
         *          "nome": "Pedro Matias",
         *          "filiacao": "UNINOVE - Universidade Nove de Julho",
         *          "foto": "arquivo.jpg"
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

            $sql = "SELECT * "
                    . "FROM palestrante "
                    . "ORDER BY nome ASC";

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
         *  @api {post} /api/palestrante/getCodigo Específico
         *  @apiVersion 0.1.0
         *  @apiName getCodigo
         *  @apiGroup Palestrante
         *  @apiDescription Utilizado para recuperação de um palestrante específico por meio do seu código. O caminho da imagem é images/
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {int} codigo_autor Código do palestrante.
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "codigo_palestrante": 1
         *  }
         * 
         *  @apiSuccess {JSON} object Recupera os dados de um palestrante específico
         *  @apiSuccess {String} foto Nome do arquivo em (/fotos/)
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *      {
         *          "codigo_palestrante": 1,
         *          "nome": "Pedro Matias",
         *          "cidade": "São Paulo",
         *          "estado": "SP",
         *          "email": "autor@instituicao.xxx",
         *          "filiacao": "UNINOVE - Universidade Nove de Julho",
         *          "curriculo": "Professor titular....",
         *          "foto": "arquivo.jpg"
         *      }
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

            $sql = "SELECT * FROM palestrante "
                    . "WHERE codigo_palestrante = :codigo_palestrante ";

            $sth = $this->PDO->prepare($sql);
            foreach ($dados as $key => $value) {
                $sth->bindValue(':codigo_palestrante', $value);
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

    }

}
