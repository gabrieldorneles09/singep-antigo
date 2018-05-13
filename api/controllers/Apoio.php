<?php

namespace controllers {

    class Apoio {

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
         *  @api {post} /api/area/getAll Áreas [Todas]
         *  @apiVersion 0.1.0
         *  @apiName getAllAreas
         *  @apiGroup Apoio
         *  @apiDescription Recupera todas as áreas
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         * 
         *  {
         *      "token": "70010500-28d38-fe14-67833256-1467833256"
         *  }
         *
         *  @apiSuccess {JSON} object Array com as áreas disponíveis
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_area": 1,
         *          "descricao": "Gestão de Projetos"
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
        public function getAreasAll() {
            global $app;
            $sth = $this->PDO->prepare(
                    "SELECT codigo_area, descricao "
                    . "FROM area "
                    . "ORDER BY descricao ASC");

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
         *  @api {post} /api/area/getCodigo Área [Específica]
         *  @apiVersion 0.1.0
         *  @apiName getCodigo
         *  @apiGroup Apoio
         *  @apiDescription Realiza a busca específica de uma área pelo seu código
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {int} codigo_area Código da área
         *  @apiParamExample {json} Exemplo de uso:
         * 
         *  {
         *      "token": "70010500-28d38-fe14-67833256-1467833256",
         *      "codigo_area": 1
         *  }
         *
         *  @apiSuccess {JSON} object Retorna a área específica
         *  @apiSuccessExample Retorno-Successo:
         * 
         *  HTTP/1.1 200 OK
         *  {
         *      "codigo_area": 1,
         *      "descricao": "Gestão de Projetos"
         *  }
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getAreaCodigo() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $sql = "SELECT * FROM area "
                    . "WHERE codigo_area = :codigo_area";

            $sth = $this->PDO->prepare($sql);
            foreach ($dados as $key => $value) {
                $sth->bindValue(':codigo_area', $value);
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
         * Temas
         */

        /**
         *  @api {post} /api/tema/getAll Temas [Todos]
         *  @apiVersion 0.1.0
         *  @apiName getAllTemas
         *  @apiGroup Apoio
         *  @apiDescription Recupera todos os temas disponíveis
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         * 
         *  { 
         *      "token": "70010500-28d38-fe14-67833256-1467833256"
         *  }
         *
         *  @apiSuccess {JSON} object Array com os temas disponíveis
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_tema": 1,
         *          "descricao": "Áreas de Especialização em Gestão de Projetos"
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
        public function getTemaAll() {
            global $app;
            $sth = $this->PDO->prepare(
                    "SELECT codigo_tema, descricao "
                    . "FROM tema "
                    . "ORDER BY codigo_area, descricao ASC");

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
         *  @api {post} /api/tema/getCodigo Tema [Específico]
         *  @apiVersion 0.1.0
         *  @apiName getCodigoTema
         *  @apiGroup Apoio
         *  @apiDescription Realiza a busca específica de um tema pelo seu código
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParam (Parâmetro) {int} codigo_tema Código do tema
         *  @apiParamExample {json} Exemplo de uso:

         *  { 
         *      "token": "70010500-28d38-fe14-67833256-1467833256",
         *      "codigo_tema": 1
         *  }
         *
         *  @apiSuccess {JSON} object Retorna o tema solicitado
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  {
         *      "codigo_tema": 1,
         *      "codigo_area": 1,
         *      "descricao": "Logística Reversa"
         *  }
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getTemaCodigo() {
            global $app;
            $dados = json_decode($app->request->getBody(), true);
            $dados = (sizeof($dados) == 0) ? $_POST : $dados;
            $keys = array_keys($dados);

            $sql = "SELECT * FROM tema "
                    . "WHERE codigo_tema = :codigo_tema";

            $sth = $this->PDO->prepare($sql);
            foreach ($dados as $key => $value) {
                $sth->bindValue(':codigo_tema', $value);
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
         *  @api {post} /api/area_tema/getAreaTemas Áreas => Temas
         *  @apiVersion 0.1.0
         *  @apiName getAreaTemas
         *  @apiGroup Apoio
         *  @apiDescription Retorna todas as áreas com os respectivos temas
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         * 
         *  { 
         *      "token":"9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         *
         *  @apiSuccess {JSON} object Retorna um objeto JSON associativo com as áreas e seus temas respectivos
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  {
         *      "area_tema": 
         *      [
         *          {
         *              "codigo_area": 1,
         *              "descricao": "Gestão de Projetos",
         *              "temas": 
         *              [
         *                  {
         *                      "codigo_tema": 1,
         *                      "descricao": "Áreas de Especialização em Gestão de Projetos"
         *                  }
         *              ]
         *          }
         *      ]
         *  }
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function getAreaTemas() {
            global $app;
            $sql_areas = $this->PDO->prepare("SELECT codigo_area, descricao FROM area ORDER BY descricao ASC");
            $sql_areas->execute();
            $result_areas = $sql_areas->fetchAll(\PDO::FETCH_ASSOC);

            $result = NULL;
            $json = array();
            try {
                foreach ($result_areas as $area) {
                    $temas = array();
                    $sql_temas = $this->PDO->prepare("SELECT * FROM tema "
                            . "WHERE codigo_area = " . $area['codigo_area'] . " "
                            . "ORDER BY descricao ASC");
                    $sql_temas->execute();
                    $result_temas = $sql_temas->fetchAll(\PDO::FETCH_ASSOC);

                    foreach ($result_temas as $tema) {
                        $temas[] = array("codigo_tema" => $tema['codigo_tema'], "descricao" => $tema['descricao']);
                    }
                    $areas = array(
                        "codigo_area" => $area['codigo_area'],
                        "descricao" => $area['descricao'],
                        "temas" => $temas
                    );
                    $result['area_tema'][] = $areas;
                }
                
                $this->PDO = NULL;
                unset($this->PDO);

                $app->render('default.php', ["data" => $result], 200);
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

        /**
         * Datas e Horários
         */

        /**
         *  @api {post} /api/data/getDataHorario Data/Horário [Todos]
         *  @apiVersion 0.1.0
         *  @apiName getDataHorario
         *  @apiGroup Apoio
         *  @apiDescription Recupera todas as datas e horários do congresso
         *  @apiParam (Parâmetro) {string} token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         * 
         *  { 
         *      "token": "70010500-28d38-fe14-67833256-1467833256"
         *  }
         *
         *  @apiSuccess {JSON} object Array com as datas/horários disponíveis
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_data": 1,
         *          "data": "08/11/2015",
         *          "dia_semana": "Domingo",
         *          "codigo_horario": 1,
         *          "horario": "17:30 às 18:30"
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
        public function getDataHorario() {
            global $app;
            $sth = $this->PDO->prepare(
                    "SELECT data.*, horario.* "
                    . "FROM data "
                    . "INNER JOIN horario "
                    . "ON horario.codigo_data = data.codigo_data"
            );

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
    
