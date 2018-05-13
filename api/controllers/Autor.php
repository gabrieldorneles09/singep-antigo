<?php

namespace controllers {

    class Autor {

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
         *  @api {post} /api/autor/getAll Todos
         *  @apiDescription Toda requisição deve conter o token do usuário no primeiro argumento do JSON
         *  @apiVersion 0.1.0
         *  @apiName getAll
         *  @apiGroup Autor 
         *  @apiDescription Utilizado para recuperação de todos os autores cadastrados
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         * 
         *  @apiSuccess {JSON} object Array com todos os autores cadastrados
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_autor": 1,
         *          "nome": "Pedro Matias",
         *          "cidade": "São Paulo",
         *          "estado": "SP",
         *          "email": "autor@instituicao.xxx",
         *          "filiacao": "UNINOVE - Universidade Nove de Julho"
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

            $sql = "SELECT codigo_autor, nome "
                    . "FROM autor "
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
         *  @api {post} /api/autor/getCodigo Específico
         *  @apiVersion 0.1.0
         *  @apiName getCodigo
         *  @apiGroup Autor
         *  @apiDescription Utilizado para recuperação de um autor específico por meio do seu código
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {int} codigo_autor Código do autor.
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "codigo_autor": 1
         *  }
         * 
         *  @apiSuccess {JSON} object Recupera os dados de um autor específico
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  {
         *      "codigo_autor": 1,
         *      "nome": "Pedro Matias",
         *      "cidade": "São Paulo",
         *      "estado": "SP",
         *      "email": "autor@instituicao.xxx",
         *      "filiacao": "UNINOVE - Universidade Nove de Julho"
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

            $sql = "SELECT * FROM autor "
                    . "WHERE codigo_autor = :codigo_autor "
                    . "ORDER BY nome ASC";

            $sth = $this->PDO->prepare($sql);
            foreach ($dados as $key => $value) {
                $sth->bindValue(':codigo_autor', $value);
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
         *  @api {post} /api/autor/getNome Nome
         *  @apiVersion 0.1.0
         *  @apiName getNome
         *  @apiGroup Autor
         *  @apiDescription Realiza a busca (LIKE) no campo nome do autor
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {string} nome Palavra chave para pesquisa
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "nome": "Pedro Matias"
         *  }
         * 
         *  @apiSuccess {JSON} object Retorna um array com todos os autores pesquisados pelo fragmento informado no campo nome
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_autor": 1,
         *          "nome": "Pedro Matias",
         *          "cidade": "São Paulo",
         *          "estado": "SP",
         *          "email": "autor@instituicao.xxx",
         *          "filiacao": "UNINOVE - Universidade Nove de Julho"
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
        public function getNome() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $sql = "SELECT * "
                    . "FROM autor "
                    . "WHERE nome LIKE :query "
                    . "ORDER BY nome ASC";

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
         *  @api {post} /api/autor/getFiliacao Filiação
         *  @apiVersion 0.1.0
         *  @apiName getFiliacao
         *  @apiGroup Autor
         *  @apiDescription Realiza a busca (LIKE) no campo filiação (Universidade) do autor
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {string} filiacao Palavra chave para a pesquisa
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "filiacao": "Uninove"
         *  }
         * 
         *  @apiSuccess {JSON} object Retorna um Array com os autores na filiação pela palavra chave informada
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_autor": 1,
         *          "nome": "Pedro Matias",
         *          "cidade": "São Paulo",
         *          "estado": "SP",
         *          "email": "autor@instituicao.xxx",
         *          "filiacao": "UNINOVE - Universidade Nove de Julho"
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
        public function getFiliacao() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $sql = "SELECT * "
                    . "FROM autor "
                    . "WHERE filiacao "
                    . "LIKE :query "
                    . "ORDER BY nome ASC";

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

        

    }

}
