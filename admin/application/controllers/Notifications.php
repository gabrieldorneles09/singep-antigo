<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->helper( 'form' );

        $token = $this->session->userdata( 'token' );

        $admin = $this->session->userdata( 'adm' );

        if( !( $token and $admin ) ) {

            redirect('/login');

        }

    }

    function newNotification() {

        $this->load->model( 'participantes_model' );

        $data = array( 'username' => $this->session->userdata( 'username' ),
                       'token' => $this->session->userdata( 'token' ),
                       'participants' => $this->participantes_model->getAllByNameAndCode() );

        $this->load->view( 'notifications/new', $data );

    }


}