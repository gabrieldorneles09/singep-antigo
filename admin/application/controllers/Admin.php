<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $token = $this->session->userdata('token');

        $admin = $this->session->userdata( 'adm' );

        if( !( $token and $admin ) ) {

            redirect('/login');

        }

    }

    public function index() {

        $data = array( 'username' => $this->session->userdata('username') );

        $this->load->view('admin', $data );
    }

}