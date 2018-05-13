<?php

namespace controllers {

    class Agenda {

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
         *  @api {put} /api/agenda/setAgendar Agendar
         *  @apiVersion 0.1.0
         *  @apiName setAgendar
         *  @apiGroup Agenda
         *  @apiDescription Realiza o agendamento de um artigo para participação
         *  @apiParam (Parâmetro) {string} Token Token de acesso
         *  @apiParam (Parâmetro) {int} codigo_artigo Código do artigo
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token":"9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "codigo_artigo": 1
         *  }
         * 
         *  @apiSuccess {JSON} object Mensagem de sucesso
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  {
         *      "codigo_agenda": 1,
         *      "codigo_participante": 1,
         *      "codigo_artigo": 45
         *  }
         * 
         *  @apiErrorExample  {json} Retorno-Agendado:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "artigo jah agendado"
         *  }
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function setAgendar() {
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

            # Verifica se o artigo já foi agendado
            $sql = "SELECT * FROM agenda "
                    . "WHERE "
                    . "codigo_participante = :codigo_participante AND "
                    . "codigo_artigo = :codigo_artigo";
            $sth = $this->PDO->prepare($sql);
            $sth->bindValue(":codigo_participante", $codigo_participante);
            $sth->bindValue(":codigo_artigo", $value);
            $sth->execute();

            $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
            $sth->execute();

            if ($sth->RowCount() == 1) {
                $app->render('default.php', ["data" => json_decode('{"retorno": "artigo jah agendado!"}')], 200);
            } else {

                # Realiza o agendamento
                $sql = "INSERT INTO agenda (codigo_participante, codigo_artigo) "
                        . "VALUES "
                        . "(:codigo_participante, :codigo_artigo)";
                $sth = $this->PDO->prepare($sql);

                $sth->bindValue(":codigo_participante", $codigo_participante);
                $sth->bindValue(":codigo_artigo", $value);

                try {
                    $sth->execute();

                    $sql = "SELECT * "
                            . "FROM agenda "
                            . "WHERE codigo_agenda = " . $this->PDO->lastInsertId();
                    $sth = $this->PDO->prepare($sql);

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

        /**
         *  @api {delete} /api/agenda/setRemover Cancelar
         *  @apiVersion 0.1.0
         *  @apiName setRemover
         *  @apiGroup Agenda
         *  @apiDescription Realiza o cancelamento de um agendamento
         *  @apiParam (Parâmetro) {string} Token Token de acesso
         *  @apiParam (Parâmetro) {int} codigo_artigo Código do artigo
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token":"9503afdf-9520-11e5-8bdb-04017fd5d401",
         *      "codigo_artigo": 1
         *  }
         * 
         *  @apiSuccess {JSON} object Mensagem de sucesso
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "Agendamento cancelado com sucesso!"
         *  }
         * 
         *  @apiErrorExample {json} Retorno-Vazio:
         *  HTTP/1.1 200 OK
         *  {
         *      "retorno": "null"
         *  }
         * 
         */
        public function setRemover() {
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
            $sql = "DELETE FROM agenda "
                    . "WHERE codigo_participante = :codigo_participante "
                    . "AND codigo_artigo = :codigo_artigo";

            $sth = $this->PDO->prepare($sql);

            $sth->bindValue(":codigo_participante", $codigo_participante);
            $sth->bindValue(":codigo_artigo", $value);

            try {
                $sth->execute();
                $result = '{"retorno": "Agendamento cancelado com sucesso!"}';

                $this->PDO = NULL;
                unset($this->PDO);

                $app->render('default.php', ["data" => json_decode($result)], 200);
            } catch (PDOException $ex) {
                $app->render('default.php', ["data" => $ex->getMessage()], 200);
            }
        }

        /**
         *  @api {post} /api/agenda/getAll Agendamentos
         *  @apiVersion 0.1.0
         *  @apiName getAll
         *  @apiGroup Agenda
         *  @apiDescription Apresenta todos os agendamentos realizados pelo participante
         *  @apiParam (Parâmetro) {string} Token Token de acesso
         *  @apiParamExample {json} Exemplo de uso:
         *  { 
         *      "token": "9503afdf-9520-11e5-8bdb-04017fd5d401"
         *  }
         *
         *  @apiSuccess {JSON} object Retorna um Array com todos os agendamentos.<br><br>
         *  <strong>Observação:</strong> Realizar a verificação da data e hora para habilitar ou não o botão de remoção e, 
         *  caso ja tenha sido apresentado, informar ao usuário
         *  @apiSuccessExample Retorno-Successo:
         *  HTTP/1.1 200 OK
         *  [
         *      {
         *          "codigo_artigo": 45,
         *          "data": "10/11/2015",
         *          "horario": "16:00 as 17:30",
         *          "area": "Sustentabilidade",
         *          "tema": "Tópicos especiais em Sustentabilidade",
         *          "local": 522,
         *          "tipo_trabalho": "Artigo",
         *          "titulo": "O DESENVOLVIMENTO DA CADEIA PRODUTIVA DO BAMBU..."
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
        public function getAll() {
            global $app;
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
            $sth = $this->PDO->prepare(
                    "SELECT artigo.codigo_artigo, artigo.data, artigo.horario, 
                    artigo.area, artigo.tema, artigo.local, artigo.tipo_trabalho, artigo.titulo 
                    FROM agenda
                    INNER JOIN artigo
                    ON agenda.codigo_artigo = artigo.codigo_artigo
                    WHERE agenda.codigo_participante = :codigo_participante 
                    ORDER BY artigo.data ASC, artigo.horario ASC");

            $sth->bindValue(":codigo_participante", $codigo_participante);

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
