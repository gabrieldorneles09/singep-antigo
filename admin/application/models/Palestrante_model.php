<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Palestrante_model extends CI_Model {

    public function __construct() {

        parent::__construct();

    }

    function getById( $id ) {

        $this->db->where( 'codigo_palestrante', $id );

        $query = $this->db->get( 'palestrante' );

        return $query->result();

    }

    public function insertData( $data ) {

        $this->db->insert( 'palestrante', $data );

    }

    public function  updateData( $data, $id ) {

        $this->db->update( 'palestrante', $data, array( "codigo_palestrante" => $id ) );

    }

}