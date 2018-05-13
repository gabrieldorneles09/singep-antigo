<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participants extends CI_Controller {

    // Form Errors
    private $form_errors = array (

        'nome' => "",

        'email' => "",

        'documento' => "",

        'telefone' => "",

        'filiacao' => "",

        'adm' => "",

        'clean' => FALSE

    );

    public function __construct() {

        parent::__construct();

        $this->load->helper( 'form' );

        $token = $this->session->userdata( 'token' );

        $admin = $this->session->userdata( 'adm' );

        if( !( $token and $admin ) ) {

            redirect('/login');

        }

    }

    function newParticipant() {

        if( $this->input->is_ajax_request() ) {

            // Validation form
            $this->load->library( 'form_validation' );

            // Set empty error delimiters
            $this->form_validation->set_error_delimiters('','');

            // Form Validation Rules
            $this->form_validation->set_rules( 'nome', 'Nome', 'required|max_length[100]' );
            $this->form_validation->set_rules( 'email', 'Email', 'required|max_length[100]|valid_email' );
            $this->form_validation->set_rules( 'documento', 'Documento', 'required' );
            $this->form_validation->set_rules( 'telefone', 'Telefone', 'required' );
            $this->form_validation->set_rules( 'filiacao', 'Filiação', 'required|max_length[200]' );
            $this->form_validation->set_rules( 'adm', 'Tipo','required|callback_check_default');
            $this->form_validation->set_message('check_default', 'Escolha o tipo de usuário.');

            // Run Form Validation

            if( !$this->form_validation->run() ) {

                // Merge forms, local and validation errors

                $this->form_errors = array_merge($this->form_errors, $this->form_validation->error_array());

            } else {

                $this->form_errors = array_merge( $this->form_errors, array( "clean" => TRUE ) );

                require_once('../api/classes/Utils.php');

                $Utils = new Utils();

                $Utils->setNome( $this->input->post('nome') );
                $Utils->setDocumento( $this->input->post( 'documento' ) );
                $Utils->geraToken();

                $token = $Utils->getToken();

                $this->load->model('participantes_model');

                $new = array(

                    'nome' => $this->input->post('nome'),
                    'email' => $this->input->post('email'),
                    'documento' => $this->input->post('documento'),
                    'telefone' => $this->input->post('telefone'),
                    'filiacao' => $this->input->post('filiacao'),
                    'adm' => $this->input->post('adm'),
                    'token' => $token

                );

                $this->participantes_model->insertData( $new );

            }

            exit( json_encode( $this->form_errors, JSON_FORCE_OBJECT ) );

        } else {

            $data = array('username' => $this->session->userdata('username'));

            $this->load->view('participants/new', $data);

        }

    }

    function listParticipants() {

        if( $this->input->is_ajax_request() ) {

            $data = array(

                "search" => '',
                "clean" => FALSE

            );

            // Validation form
            $this->load->library('form_validation');

            // Set empty error delimiters
            $this->form_validation->set_error_delimiters('','');

            // Form Validation Rules
            $this->form_validation->set_rules( 'search', 'Search', 'required' );
            $this->form_validation->set_message( 'required', 'Digite um nome, email, documento ou parte deles.' );

            if( !$this->form_validation->run()  ) {

                $data = array_merge( $data, $this->form_validation->error_array() );

            } else {

                $this->load->model('participantes_model');

                $data = array_merge( $data, array( "clean" => TRUE, "search" => $this->participantes_model->getByLike( $this->input->post( 'search' ) )  ) );

            }

            exit( json_encode( $data, JSON_FORCE_OBJECT ) );

        } else {

            $this->load->library('pagination');

            $this->load->model('participantes_model');

            // Configure pagination
            $max = 20;

            $config['base_url'] = base_url('participants/listParticipants');
            $config['total_rows'] = $this->participantes_model->contRegisters();
            $config['per_page'] = $max;
            $config['num_links'] = 2;

            $config['first_link'] = 'Primeiro';
            $config['last_link'] = 'Último';
            $config['next_link'] = 'Próximo';
            $config['prev_link'] = 'Anterior';

            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li><a style="background-color: #337ab7; color: white;">';
            $config['cur_tag_close'] = '</a></li>';

            $this->pagination->initialize( $config );

            $data = array('username' => $this->session->userdata('username'),
                'token' => $this->session->userdata('token'),
                'links' => $this->pagination->create_links(),
                'participants' => $this->participantes_model->getList($max, $this->uri->segment("3")));

            $this->load->view( 'participants/list', $data );

        }

    }

    function updateParticipant() {

        if( $this->input->is_ajax_request() ) {

            // Validation form
            $this->load->library( 'form_validation' );

            // Set empty error delimiters
            $this->form_validation->set_error_delimiters('','');

            // Form Validation Rules
            $this->form_validation->set_rules( 'nome', 'Nome', 'required|max_length[100]' );
            $this->form_validation->set_rules( 'email', 'Email', 'required|max_length[100]|valid_email' );
            $this->form_validation->set_rules( 'documento', 'Documento', 'required' );
            $this->form_validation->set_rules( 'telefone', 'Telefone', 'required' );
            $this->form_validation->set_rules( 'filiacao', 'Filiação', 'required|max_length[200]' );
            $this->form_validation->set_rules( 'adm', 'Tipo','required|callback_check_default');
            $this->form_validation->set_message('check_default', 'Escolha o tipo de usuário.');

            // Run Form Validation

            if( !$this->form_validation->run() ) {

                // Merge forms, local and validation errors

                $this->form_errors = array_merge($this->form_errors, $this->form_validation->error_array());

            } else {

                $this->form_errors = array_merge( $this->form_errors, array( "clean" => TRUE ) );

                $this->load->model('participantes_model');

                $new = array(

                    'nome' => $this->input->post('nome'),
                    'email' => $this->input->post('email'),
                    'documento' => $this->input->post('documento'),
                    'telefone' => $this->input->post('telefone'),
                    'filiacao' => $this->input->post('filiacao'),
                    'adm' => $this->input->post('adm')

                );

                $this->participantes_model->updateData( $new, $this->input->post('update_id') );

            }

            exit( json_encode( $this->form_errors, JSON_FORCE_OBJECT ) );


        } else {

            $uri = $this->uri->segment( '3' );

            if( $uri ) {

                $this->load->model( 'participantes_model' );

                $participants = $this->participantes_model->getById( $uri );

                if( $participants ) {

                    $data = array( 'username' => $this->session->userdata( 'username' ),
                                   'update_id' => $uri,
                                   'participants' => $participants );

                    $this->load->view( 'participants/update', $data );

                } else {

                    redirect( 'participants/listParticipants' );

                }

            } else {

                redirect( 'participants/listParticipants' );

            }

        }

    }

    function check_default( $value ) {

        return $value == "Escolha uma opção..." ? FALSE : TRUE;

    }

}