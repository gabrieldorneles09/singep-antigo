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
                        <h3>Notificações</h3>
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
                                <h2>Formulário de notificações <small>preencha todos os campos</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <?php echo form_open( 'notifications/newNotification', array( 'id' => 'form-new-notification', 'class' => 'form-horizontal form-label-left') )  ?>

                                <div class="form-group">
                                    <!--label for="to-send-notification">Destino</label-->
                                    <!--div class="col-md-9 col-sm-9 col-xs-12"-->
                                    <p class="font-gray-dark text-justify">Escolha os contatos. Escolha a opção "todos" para enviar a notificação para todos os usuários, ou escolha individualmente cada usuário que deseja enviar a notificação.</p>
                                        <select id="send-notification" style="width: 100%;" name="to-send-notification" class="select2_multiple form-control" multiple="multiple">
                                            <option value="all">Todos</option>
                                            <?php foreach( $participants as $participant ) {

                                                echo '<option value="' . $participant->codigo_participante . '">' . $participant->nome . '</option>';

                                            }?>

                                        </select>
                                    <!--/div-->
                                </div>

                                <div class="form-group">

                                    <!--div class="col-md-12 col-sm-12 col-xs-12"-->
                                    <p class="font-gray-dark text-justify">Digite uma mensagem, ela será enviada aos usuários escolhidos acima.</p>
                                        <textarea required="required" style="width: 100%; max-width: 100%;" id="texto" class="form-control" rows="10"></textarea>
                                    <!--/div-->

                                </div>

                                <div class="ln_solid"></div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                        <button id="clean-form-participant" class="btn btn-primary">Limpar</button>
                                        <button type="submit" class="btn btn-success">Enviar</button>
                                    </div>
                                </div>

                                <p id="response-notification" class="text-center font-gray-dark" style="margin-bottom: -5px;" ></p>

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

    <!-- Select2 -->
    <script src="<?php echo base_url()."assets/vendors/select2/dist/js/select2.full.min.js" ?>"></script>

    <script type="text/javascript">

        var token = "<?php echo $token; ?>";

        $(function() {

            $(":input").inputmask();

            // Select

            $( "#send-notification" ).select2({

                placeholder: " Selecione os contatos para enviar a mensagem",

                allowClear: true

            });

            $( '#clean-form-participant').on( 'click', function( e ) {

                e.preventDefault();

            });

            // Form new notification

            $( "#form-new-notification").on( 'submit', function( e ) {

                e.preventDefault();

                var selected = $( "#send-notification" ).select2( 'data'), url = '',
                    allcods = [], allcodslenght, tipo = 1, cont = 1, texto = $( '#texto' ).val();

                for( var value in selected ) {

                    if ( selected.hasOwnProperty( value ) ) {

                        var s = selected[ value ];

                        if ( s.id == "all" ) {

                            allcods = [];

                            allcods.push( s.id );

                            tipo = 0;

                            break;

                        }

                        allcods.push( s.id );

                    }

                }

                allcodslenght = allcods.length;

               var send = function( codigo ) {

                    $.ajax({

                        url: 'http://singep.000webhostapp.com/singep/api/api/notificacao/setEnviar',
                        //url: 'http://singep.tecnologia.ws/api/notificacao/setEnviar',
                        //url: 'http://singep.esy.es/api/notificacao/setEnviar',
                        type: 'PUT',
                        data : JSON.stringify({ 'token' : token,
                                 'texto' : texto,
                                 'url' :  url,
                                 'tipo' : tipo,
                                 'codigo_participante': codigo }),

                        success: function( response ) {

                            //console.log( token, texto, url, tipo );

                            //console.log( response );

                            if( cont >= allcodslenght ) {

                                response = JSON.parse( response );

                                $('#response-notification').html( response[ "retorno" ] );

                                return false;

                            }

                            send( allcods[ cont ] );

                            cont = cont + 1;

                        }

                    });

                };

                if( !$.isEmptyObject( allcods ) ) {

                    send( allcods[ 0 ] );

                }


            });

        });


    </script>


</body>
</html>