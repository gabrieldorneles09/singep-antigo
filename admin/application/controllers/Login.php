<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->helper( 'form' );

        $token = $this->session->userdata( 'token' );

        $admin = $this->session->userdata( 'adm' );

        if( $token and $admin ) {

            redirect('/admin');

        }

    }

    public function index() {

        if( $this->input->is_ajax_request() ) {

            $this->session->set_userdata( 'token', $this->input->post('token') );

            $this->session->set_userdata( 'adm', $this->input->post('adm') );

            $this->session->set_userdata( 'username', $this->input->post('username') );

            exit( json_encode( true , JSON_FORCE_OBJECT ) );

        } else {

            $this->load->view('login');

        }

    }

}