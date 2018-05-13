<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Speakers extends CI_Controller {

    // Form Errors
    private $form_errors = array (

        'nome' => "",

        'cidade' => "",

        'estado' => "",

        'email' => "",

        'filiacao' => "",

        'curriculo' => "",

        'image-upload' => "",

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

    public function newSpeaker() {

        if( $this->input->is_ajax_request() ) {

            // Validation form
            $this->load->library('form_validation');

            // Set empty error delimiters
            $this->form_validation->set_error_delimiters('','');

            // Form Validation Rules
            $this->form_validation->set_rules( 'nome', 'Nome', 'required|max_length[100]' );
            $this->form_validation->set_rules( 'cidade', 'Cidade', 'required' );
            $this->form_validation->set_rules( 'estado', 'Estado', 'required' );
            $this->form_validation->set_rules( 'email', 'Email', 'required|max_length[100]|valid_email' );
            $this->form_validation->set_rules( 'filiacao', 'Filiação', 'required|max_length[200]' );
            $this->form_validation->set_rules( 'curriculo', 'Curriculo', 'required' );
            $this->form_validation->set_rules( 'image-upload', 'Imagem', 'callback_file_selected_test' );

            // Run Form Validation

            if( !$this->form_validation->run() ) {

                // Merge forms, local and validation errors

                $this->form_errors = array_merge( $this->form_errors, $this->form_validation->error_array() );

            } else {

                // Save values in DB

                $this->load->model( 'palestrante_model' );

                $new = array(

                    'nome' => $this->input->post('nome'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'email' => $this->input->post('email'),
                    'filiacao' => $this->input->post('filiacao'),
                    'curriculo' => $this->input->post('curriculo'),

                );

                $this->palestrante_model->insertData( $new );

                $id = $this->db->insert_id();

                $this->palestrante_model->updateData( array( "foto" => $id.'.png' ), $id );

                // Upload picture

                $upload_config = array(

                    'upload_path' => '../api/fotos/',
                    'allowed_types' => '*',
                    'file_name' => $id.'.png'

                );

                $this->load->library( 'upload', $upload_config );

                $this->upload->do_upload( 'image-upload' );

                $this->form_errors = array_merge( $this->form_errors, array( "clean" => TRUE, 'id' => $id ) );

            }

            exit( json_encode( $this->form_errors, JSON_FORCE_OBJECT ) );

        } else {

            $data = array( 'username' => $this->session->userdata( 'username' ) );

            $this->load->view( 'speakers/new', $data );
        }
    }

    public function listSpeaker() {


        $data = array( 'username' => $this->session->userdata('username'),
                       'token' => $this->session->userdata('token'));

        $this->load->view( 'speakers/list', $data );

    }

    function file_selected_test(){

        $this->form_validation->set_message('file_selected_test', 'O campo Imagem é obrigatório.');
        if (empty($_FILES['image-upload']['name'])) {
            return false;
        }else{
            return true;
        }
    }

    function updateSpeaker() {

        if( $this->input->is_ajax_request() ) {

            // Validation form
            $this->load->library('form_validation');

            // Set empty error delimiters
            $this->form_validation->set_error_delimiters('','');

            // Form Validation Rules
            $this->form_validation->set_rules( 'nome', 'Nome', 'required|max_length[100]' );
            $this->form_validation->set_rules( 'cidade', 'Cidade', 'required' );
            $this->form_validation->set_rules( 'estado', 'Estado', 'required' );
            $this->form_validation->set_rules( 'email', 'Email', 'required|max_length[100]|valid_email' );
            $this->form_validation->set_rules( 'filiacao', 'Filiação', 'required|max_length[200]' );
            $this->form_validation->set_rules( 'curriculo', 'Curriculo', 'required' );

            $image_upload_before = $this->input->post( 'image-upload-before' );

            if( !$image_upload_before ) {

                $this->form_validation->set_rules( 'image-upload', 'Imagem', 'callback_file_selected_test' );

            }

            // Run Form Validation

            if( !$this->form_validation->run() ) {

                // Merge forms, local and validation errors

                $this->form_errors = array_merge( $this->form_errors, $this->form_validation->error_array() );

            } else {

                // Save values in DB

                $this->load->model( 'palestrante_model' );

                $new = array(

                    'nome' => $this->input->post( 'nome' ),
                    'cidade' => $this->input->post( 'cidade' ),
                    'estado' => $this->input->post( 'estado' ),
                    'email' => $this->input->post( 'email' ),
                    'filiacao' => $this->input->post( 'filiacao' ),
                    'curriculo' => $this->input->post( 'curriculo' ),
                    'foto' => '1_padrao.png'

                );

                $this->palestrante_model->updateData( $new, $this->input->post( 'codigo_palestrante' ) );

                // Upload picture

                if( !$image_upload_before ) {

                    $upload_config = array(

                        'upload_path' => '../api/fotos/',
                        'allowed_types' => '*',
                        'overwrite' =>  TRUE,
                        'file_name' => $this->input->post( 'codigo_palestrante' ) . '.png'

                    );

                    $this->load->library( 'upload', $upload_config );

                    $this->upload->do_upload( 'image-upload' );


                    $new = array(
                       'foto' => $this->input->post( 'codigo_palestrante' ) . '.png',
                    );

                $this->palestrante_model->updateData( $new, $this->input->post( 'codigo_palestrante' ) );



                    

                }

                $this->form_errors = array_merge( $this->form_errors, array( "clean" => TRUE ) );

            }

            exit( json_encode( $this->form_errors, JSON_FORCE_OBJECT ) );


        } else {

            $uri = $this->uri->segment( '3' );

            if( $uri ) {

                $this->load->model( 'palestrante_model' );

                $speaker = $this->palestrante_model->getById( $uri );

                if( $speaker ) {

                    $data = array( 'username' => $this->session->userdata( 'username' ),
                                   'update_id' => $uri,
                                   'speakers' => $speaker );

                    $this->load->view( 'speakers/update', $data );

                } else {

                    redirect( 'speakers/listSpeaker' );

                }

            } else {

                redirect( 'speakers/listSpeaker' );

            }


        }

    }

}