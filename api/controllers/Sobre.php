<?php

namespace controllers {

    class Sobre {

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
         *  @api {put} /api/sobre/getAll Sobre
         *  @apiVersion 0.1.0
         *  @apiName getAll
         *  @apiGroup Sobre
         *  @apiDescription Realiza a recuperação do sobre
         *  @apiParam (Parâmetro) {string} Token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token":"9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         * 
         *  @apiSuccess {JSON} object Mensagem de sucesso
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  {
         *      "codigo_sobre": 1,
         *      "conteudo": "html formatado"
         *  }
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

            $sql = "SELECT * FROM sobre; ";

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
