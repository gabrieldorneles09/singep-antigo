<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participantes_model extends CI_Model {

    function insertData( $data ) {

        $this->db->insert( 'participante', $data );

    }

    function getAllByNameAndCode() {

        $this->db->select( 'codigo_participante, nome' );

        $this->db->order_by( "nome", "asc" );

        $query = $this->db->get( 'participante' );

        return $query->result();

    }

    function getById( $id ) {

        $this->db->where( 'codigo_participante', $id );

        $query = $this->db->get( 'participante' );

        return $query->result();

    }

    function getByLike( $value ) {

        $value = strtolower( $value );

        $this->db->like( 'LOWER(nome)', $value );
        $this->db->or_like( 'LOWER(email)', $value );
        $this->db->or_like( 'LOWER(documento)', $value );

        $query = $this->db->get( 'participante' );

        return $query->result();

    }

    function getList( $max, $init = 0 ) {
        
        $this->db->order_by( "nome", "asc" );
        $query= $this->db->get( 'participante', $max, $init );
        return $query->result();

    }

    function contRegisters() {

        return $this->db->count_all_results( 'participante' );

    }

    function updateData( $data, $id ) {

        $this->db->update( 'participante', $data, array( "codigo_participante" => $id ) );

    }

}