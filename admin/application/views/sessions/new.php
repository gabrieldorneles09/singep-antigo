<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Singep</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url()."assets/vendors/bootstrap/dist/css/bootstrap.min.css" ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()."assets/vendors/font-awesome/css/font-awesome.min.css" ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url()."assets/vendors/nprogress/nprogress.css" ?>" rel="stylesheet">

    <!-- Cropper -->
    <link href="<?php echo base_url()."assets/vendors/cropper/dist/cropper.css" ?>"  rel="stylesheet">

    <!-- Select2 -->
    <link href="<?php echo base_url()."assets/vendors/select2/dist/css/select2.min.css" ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()."assets/build/css/custom.min.css" ?>" rel="stylesheet">

    <link href="<?php echo base_url()."assets/css/main.css" ?>" rel="stylesheet">

    <!-- Datatables -->
    <link href="<?php echo base_url()."assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" ?>" rel="stylesheet">
    <link href="<?php echo base_url()."assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" ?>" rel="stylesheet">
    <link href="<?php echo base_url()."assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" ?>" rel="stylesheet">
    <link href="<?php echo base_url()."assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" ?>" rel="stylesheet">
    <link href="<?php echo base_url()."assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" ?>" rel="stylesheet">

</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;  background-color: #1ABB9C;">
                    <a href="<?php echo base_url(); ?>" class="site_title">
                        <!--img width="40px" height="30px" src="<?php echo base_url()."assets/images/logo.png";  ?>" /-->
                        <i style="font-size: 0.95em;" class="fa fa-pie-chart"></i>
                        <span>Singep admin</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li><a href="<?php echo site_url("admin") ?>"><i class="fa fa-home"></i> Home <span class="label label-success pull-right">Retornar</span></a></li>
                            <li><a><i class="fa fa-graduation-cap"></i> Palestrantes <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo site_url("speakers/newSpeaker") ?>" >Incluir</a></li>
                                    <li><a href="<?php echo site_url("speakers/listSpeaker") ?>" >Listar</a></li>
                                </ul>
                            </li>

                            <li><a><i class="fa fa-user"></i> Participantes <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo site_url("participants/newParticipant") ?>" >Incluir</a></li>
                                    <li><a href="<?php echo site_url("participants/listParticipants") ?>" >Listar</a></li>
                                </ul>
                            </li>

                            <li><a><i class="fa fa-send"></i> Notificações <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo site_url("notifications/newNotification") ?>" >Enviar</a></li>
                                </ul>
                            </li>

                            <li><a><i class="fa fa-university"></i> Sessões <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo site_url("sessions/newSession") ?>" >Incluir</a></li>
                                    <li><a href="<?php echo site_url("sessions/listSession") ?>" >Listar</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>

                </div>
                <!-- /sidebar menu -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <!--img src="images/img.jpg" alt=""--><?php echo $username;  ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <!--li><a href="javascript:;"> Profile</a></li-->
                                <li><a href="<?php echo base_url("logout"); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->



        <!-- page content -->

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Sessões</h3>
                    </div>

                </div>

                <br>
                <br>

                <div class="clearfix"></div>
                <div class="row">

                    <div class="col-md-2 col-sm-0 col-xs-0"></div>

                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Cadastro de sessões <small>preencha todos os campos</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <?php echo form_open('sessions/newSession', array('id' => 'form-new-session', 'class' => 'form-horizontal form-label-left')) ?>            
                                    
                                    <div class="form-group" style="margin-top: 7px;">
                                        <?php 
                                            echo form_label('Participante: ', 'participante', array(
                                                'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
                                            )); 
                                        ?>

                                        <div class="col-md-6 col-sm-6 col-xs-12">

                                           <select id="new-session" name="participante" class="form-control col-md-7 col-xs-12">
                                                <option value="null"></option>
                                                <?php foreach( $participants as $participant ) {

                                                    echo '<option value="' . $participant->codigo_participante . '">' . $participant->nome . '</option>';
                                                    
                                                }
                                                ?>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class='form-group'>
                                        <?php 
                                            echo form_label('Sala: ', 'sala', array(
                                                'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
                                            ));
                                        ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php
                                                echo form_input(
                                                    array(
                                                        'id' => 'sala',
                                                        'name' => 'sala',
                                                        'type' => 'number',
                                                        'class' => 'form-control col-md-7 col-xs-12',
                                                    ));
                                            ?>
                                        </div>
                                    </div>
                                        
                                    <div class='form-group'>
                                        <?php 
                                            echo form_label('Data: ', 'data', array(
                                                'class' => 'control-label col-md-3 col-sm-3 col-xs-12',
                                            ));
                                        ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php
                                            echo form_input(
                                                array(
                                                    'id' => 'data',
                                                    'name' => 'data',
                                                    'type' => 'date',
                                                    'class' => 'form-control col-md-7 col-xs-12'
                                                ));
                                        ?>
                                    </div>

                                </div>
                                <div class='ln_solid'></div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                        <?php
                                            echo form_button(array(
                                                "class" => "btn btn-success",
                                                "content" => "Cadastrar",
                                                "type" => "submit"
                                            ));
                                        ?>
                                    </div>
                                   <!-- <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                        <button type="submit" class="btn btn-success">Cadastrar</button>
                                    </div> -->
                                </div>

                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->



        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Singep - by <a target="_blank" href="http://www.uninove.br/">Uninove</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

    </div>

<!-- jQuery -->
<script src="<?php echo base_url()."assets/vendors/jquery/dist/jquery.min.js" ?>"></script>

<!-- Bootstrap -->
<script src="<?php echo base_url()."assets/vendors/bootstrap/dist/js/bootstrap.min.js" ?>"></script>

<!-- FastClick -->
<script src="<?php echo base_url()."assets/vendors/fastclick/lib/fastclick.js" ?>"></script>

<!-- NProgress -->
<script src="<?php echo base_url()."assets/vendors/nprogress/nprogress.js" ?>"></script>

<!-- Skycons -->
<script src="<?php echo base_url()."assets/vendors/skycons/skycons.js" ?>"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo base_url()."assets/build/js/custom.min.js" ?>"></script>

<!-- Select2 -->
<script src="<?php echo base_url()."assets/vendors/select2/dist/js/select2.full.min.js" ?>"></script>

<!-- Datatables -->

<script src="<?php echo base_url()."assets/vendors/datatables.net/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js" ?>"></script>

<script src="<?php echo base_url()."assets/vendors/datatables.net-buttons/js/buttons.flash.min.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/datatables.net-buttons/js/buttons.html5.min.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/datatables.net-buttons/js/buttons.print.min.js" ?>"></script>

<script src="<?php echo base_url()."assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js" ?>"></script>
<!--script src="<?php echo base_url()."assets/vendors/datatables.net-scroller/js/datatables.scroller.min.js" ?>"></script-->

<script src="<?php echo base_url()."assets/vendors/jszip/dist/jszip.min.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/pdfmake/build/pdfmake.min.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/pdfmake/build/vfs_fonts.js" ?>"></script>


</body>

</html>