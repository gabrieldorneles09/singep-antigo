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
                        <h3>Participantes</h3>
                    </div>

                    <!--div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button">Go!</button>
                        </span>
                            </div>
                        </div>
                    </div-->

                </div>

                <br>
                <br>

                <div class="clearfix"></div>
                <div class="row">

                    <div class="col-md-2 col-sm-0 col-xs-0"></div>

                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Formulário de atualização <small>preencha todos os campos</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <br />

                                <?php echo form_open( 'participants/updateParticipant', array( 'id' => 'form-update-participant', 'class' => 'form-horizontal form-label-left') )  ?>

                                <input name="update_id" type="hidden" value="<?php echo $update_id; ?>" />

                                <?php foreach( $participants as $participant ) ?>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?php echo $participant->nome; ?>" maxlength="100" type="text" name="nome" id="nome" class="form-control col-md-7 col-xs-12">
                                        <div id="nome_error" class="form-error-message">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?php echo $participant->email; ?>" maxlength="100" type="text" name="email" id="email" class="form-control col-md-7 col-xs-12">
                                        <div id="email_error" class="form-error-message">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="documento">Documento <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?php echo $participant->documento; ?>" maxlength="25" type="text" name="documento" id="documento" class="form-control col-md-7 col-xs-12">
                                        <div id="documento_error" class="form-error-message">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefone">Telefone <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                    <input value="<?php echo $participant->telefone; ?>" data-inputmask="'mask' : '9{0,1}9{0,1}(99) 9{4,5}-9999'" maxlength='50' type='text' name='telefone' id='telefone' class='form-control col-md-7 col-xs-12'>

                                    <div id="telefone_error" class="form-error-message">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="filiacao">Filiação <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?php echo $participant->filiacao; ?>" maxlength="200" type="text" name="filiacao" id="filiacao" class="form-control col-md-7 col-xs-12">
                                        <div id="filiacao_error" class="form-error-message">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adm">Tipo <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <select id="adm" name="adm" class="form-control">
                                            <option>Escolha uma opção...</option>

                                            <?php

                                            if( $participant->adm == "1" ) {
                                                echo
                                                    '<option value="0">Normal</option>
                                                    <option value="1" selected>Administrador</option>';
                                            } else {
                                                echo
                                                '<option value="0" selected>Normal</option>
                                                    <option value="1">Administrador</option>';
                                            }

                                            ?>

                                        </select>

                                        <div id="adm_error" class="form-error-message">
                                        </div>

                                    </div>
                                </div>

                                <div class="ln_solid"></div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button id="clean-form-participant" class="btn btn-primary">Limpar formulário</button>
                                        <button type="submit" class="btn btn-success">Atualizar</button>
                                    </div>
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

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

    <!-- jquery.inputmask -->
    <script src="<?php echo base_url()."assets/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js" ?>"></script>

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

    <script src="<?php echo base_url()."assets/vendors/cropper/dist/cropper.min.js" ?>"></script>

    <script type="text/javascript">

        $(function() {

            $(":input").inputmask();

            $( '#clean-form-participant').on('click', function( e ) {

                e.preventDefault();

                $('#nome').val('');

                $('#email').val('');

                $('#documento').val('');

                $('#telefone').val('');

                $('#filiacao').val('');

            });

            // Form new speaker

            $( "#form-update-participant").on( 'submit', function( e ) {

                e.preventDefault();

                var formData = new FormData( this );

                $.ajax({

                    url: '<?php echo base_url('participants/updateParticipant'); ?>',
                    type: "POST",
                    data:  formData,
                    contentType: false,
                    cache: false,
                    dataType: 'json',
                    processData:false,

                    success: function( data ) {

                        if( data[ "clean" ] == false ) {

                            delete data[ "clean" ];

                            for( var value in data ) {

                                if( data.hasOwnProperty( value ) ) {

                                    $( '#' + value + '_error').html( data[ value ] );

                                }

                            }

                        } else {

                            delete data[ "clean" ];

                            for( var value in data ) {

                                if( data.hasOwnProperty( value ) ) {

                                    $( '#' + value + '_error').html( '' );

                                }

                            }

                            $( '#adm_error').html( 'Participante atualizado com sucesso!' );

                        }

                    }

                });


            });

        });


    </script>


</body>
</html>