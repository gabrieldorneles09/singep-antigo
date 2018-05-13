<?php

include "./config.php";


// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 8640000');    // cache for 100 days
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}

# Autoload
$loader = require 'vendor/autoload.php';

# Instancia o objeto $app
$app = new \Slim\Slim(array(
    'templates.path' => 'templates'
        ));

# Verificação da passagem do Token
try {
    $PDO = new \PDO(
            DB_TYPE . ":host=" .
            HOSTNAME . ";dbname=" .
            DB_NAME, DB_USER, DB_PASSWORD
    );
    $PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $PDO->setAttribute(\PDO::ATTR_PERSISTENT, FALSE);
    $PDO->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf-8");
    $PDO->exec("set names utf8");

    $dados = json_decode($app->request->getBody(), true);
    $dados = (sizeof($dados) == 0) ? $_POST : $dados;
    $keys = array_keys($dados);

    $flag = FALSE;
    foreach ($dados as $key => $value) {
        if ($key == "login") {
            $flag = $value;
        }
    }

    # Processo de login
    if ($flag) {
        # API - Login
        include "./api/login.php";
        //echo "entrou";
        # Executa a aplicação
        $app->run();
    } else {

        $sql = "SELECT codigo_participante FROM participante WHERE token = :token";
        $sth = $PDO->prepare($sql);

        foreach ($dados as $key => $value) {
            if ($key == 'token') {
                $sth->bindValue(':token', $value);
            }
        }
        $sth->execute();

        # Verifica se o Token é válido
        if (($sth->RowCount() > 0)) {

            # API - Autor
            include "./api/autor.php";

            # API - Artigo
            include "./api/artigo.php";

            # API - Controle Sessão
            include "./api/sessao.php";

            # API - Apoio
            include "./api/apoio.php";

            # API - Agenda
            include "./api/agenda.php";  
            
            # API - Notificacao
            include "./api/notificacao.php";    
            
            # API - Palestrante
            include "./api/palestrante.php";    

            # API - Programacao
            include "./api/programacao.php";    
            
            # API - Sobre
            include "./api/sobre.php";    
            
            # Executa a aplicação
            $app->run();
        } else {
            //$app->render('default.php', ["data" => $result], 200);
            echo '{"status": "acesso negado"}';
        }
    }
} catch (PDOException $e) {
    echo '{"status": "acesso negado"}';
    //echo $e;
    //echo $e->getTraceAsString();
}

//header("Location: ./doc/");
