<?php

/**
 * Description of Utils
 *
 * @author Edson Melo de Souza <souzaem at outlook.com>
 */
class Utils {

    private $nome;
    private $documento;
    private $token;

    function __construct() {
        
    }

    public function geraToken() {
        $tNome = strlen($this->nome);
        $i = 0;
        $nNome = NULL;
        for ($i = 0; $i < $tNome; $i++) {
            if (substr($this->nome, $i, 1) != " ") {
                $nNome .= strtoupper(substr($this->nome, $i, 1));
            }
        }
        $documento = preg_replace('/[^0-9]/', '', $this->documento);
        $data_hora = date(time());

        $tmp = md5(md5($nNome) . $documento . microtime());

        $p4 = substr($data_hora, 2, 8);
        $p3 = substr($tmp, 0, 2) . substr($data_hora, 0, 2);
        $p2 = substr($tmp, 3, 5);
        $p1 = preg_replace('/[^0-9]/', '', substr(microtime(), 1, 10)); //0410956001467729992
        $p0 = preg_replace('/[^0-9]/', '', substr(microtime(), 10, 11));

        $this->token = $p1 . '-' . $p2 . '-' . $p3 . '-' . $p4 . '-' . $p0;
    }

    public function getToken() {
        return $this->token;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
        return $this;
    }

}

/*$x = new Utils();
$x->setNome("Edson Melo de Souza");
$x->setDocumento("091719358-00");
$x->geraToken();
echo $x->getToken();*/
        
