<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->helper( 'form' );

        $token = $this->session->userdata( 'token' );

        $admin = $this->session->userdata( 'adm' );

        if( !( $token and $admin ) ) {

            redirect('/login');

        }

    }

    public function newSession(){

        $this->load->model( 'participantes_model' );

        $data = array( 'username' => $this->session->userdata( 'username' ),
                       'token' => $this->session->userdata( 'token' ),
                       'participants' => $this->participantes_model->getAllByNameAndCode() );
        
        if(  $this->input->post("participante") &&
             $this->input->post("sala") && 
             $this->input->post("data")
        ){

            $datat = explode("-", $this->input->post("data"));
            $datat = implode("-", $datat);

            $sessao = array(
                'codigo_participante' => $this->input->post("participante"),
                'sala' => $this->input->post("sala"),
                'data_hora' => $datat
            );

            $this->load->model('sessao_model');
            $this->sessao_model->salva($sessao);
        }

        $this->load->view( 'sessions/new.php', $data );

    }

    function listSession() {


        $this->load->model( 'sessao_model' );


        // Agrupation by class

        $sessionsByClass = $this->sessao_model->getByClass();

        $salas = array( "Todas" => array() ); $keys_salas = array();

        foreach( $sessionsByClass as $session ) {

            array_push( $salas[ "Todas" ], $session );

            if( !isset( $salas[ $session[ "sala" ] ] ) ) {

                $salas[ $session[ "sala" ] ] = array( $session );

                array_push( $keys_salas, $session[ "sala" ] );

            } else {

                array_push( $salas[ $session[ "sala" ] ], $session );

            }

        }

        // Agrupation by date

        $sessionsByDate = $this->sessao_model->getByDate();

        $dates = array( "Todas" => array() ); $keys_dates = array();

        foreach( $sessionsByDate as $session ) {

            $createDate = new DateTime( $session[ "data_hora" ] );

            $date = $createDate->format( 'd-m-Y' );

            array_push( $dates[ "Todas" ], $session );

            if( !isset( $dates[ $date ] ) ) {

                $dates[ $date ] = array( $session );

                array_push( $keys_dates, $date );

            } else {

                array_push( $dates[ $date ], $session );

            }

        }


        // Agrupation by hour interval '>=' and '<'

        $sessionMinMax = $this->sessao_model->getIntervals();

        $hoursIntervals = array( "Todos" => array() ); $hoursIntervalsKeys = array();

        foreach( $sessionMinMax as $session ) {

            $hours = explode( " as ", $session[ "horario" ] );

            $date = $session[ "data" ];

            $rows = $this->sessao_model->getByIntervals( $date . ' ' . $hours[ 0 ], $date . ' ' . $hours[ 1 ] );

            

            foreach( $rows as $row ) {

                array_push( $hoursIntervals[ "Todos" ], $row );

                if( !isset( $hoursIntervals[ $session[ "horario" ] ] ) ) {

                    $hoursIntervals[ $session[ "horario" ] ] = array( $row );

                    array_push( $hoursIntervalsKeys, $session[ "horario" ] );

                } else {

                    array_push( $hoursIntervals[ $session[ "horario" ] ], $row );

                }

            }

        }

        
        $data = array(   'salas' => $salas,
                         'keys_salas' => $keys_salas,
                         'dates' => $dates,
                         'keys_dates' => $keys_dates,
                         'hoursIntervals' => $hoursIntervals,
                         'hoursIntervalsKeys' => $hoursIntervalsKeys,
                         'username' => $this->session->userdata( 'username' ) );

        $this->load->view( 'sessions/list', $data );

    }



}