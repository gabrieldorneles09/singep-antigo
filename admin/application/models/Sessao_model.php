<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessao_model extends CI_Model {

    function getIntervals() {

        $this->db->select( '*' );
        $this->db->from( 'horario' );
        $this->db->join( 'data' , 'horario.codigo_data = data.codigo_data' );
        $this->db->order_by( 'data, horario' );

        $query = $this->db->get();

        return $query->result_array();

    }

    function getByIntervals( $min, $max ) {

        $this->db->select( 'nome, email, telefone, sala' );
        $this->db->from( 'sessao' );
        $this->db->join( 'participante', 'sessao.codigo_participante = participante.codigo_participante' );
        $this->db->where( "(data_hora >= '".$min."' AND data_hora < '".$max."')", NULL, FALSE );

        $query = $this->db->get();

        return $query->result_array();

    }

    function getByDate() {

        $this->db->select( 'sessao.codigo_participante, data_hora, nome, email, telefone, sala' );
        $this->db->from( 'sessao' );
        $this->db->join( 'participante', 'sessao.codigo_participante = participante.codigo_participante' );
        $this->db->group_by( 'sessao.data_hora, sessao.codigo_participante' );

        $query = $this->db->get();

        return $query->result_array();

    }

    function getByClass() {

        $this->db->select( 'nome, email, telefone, sala' );
        $this->db->from( 'sessao' );
        $this->db->join( 'participante', 'sessao.codigo_participante = participante.codigo_participante' );
        $this->db->group_by( 'sessao.sala, sessao.codigo_participante' );

        $query = $this->db->get();

        return $query->result_array();

    }
/*
    function insertData( $data ) {

        $this->db->insert( 'sessao', $data );

    }
*/
    public function salva( $data ){
        $this->db->insert( 'sessao', $data );
    }

}