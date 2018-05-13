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

    <link href="<?php echo base_url()."assets/css/new-speaker.css" ?>" rel="stylesheet">

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

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Palestrantes</h3>
                        <br>
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

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <div id="speakers-list-container" class="row">

                                    <br>

                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center"></div>

                                    <div class="clearfix"></div>

                                    <div id="speakers-list-container-first" class="col-md-4 col-sm-4 col-xs-12" ></div>

                                    <div id="speakers-list-container-second" class="col-md-4 col-sm-4 col-xs-12"></div>

                                    <div id="speakers-list-container-third" class="col-md-4 col-sm-4 col-xs-12"></div>

                                </div>
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

</body>

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

    <script type="text/javascript">

        var base_url = "<?php echo base_url('speakers/updateSpeaker/'); ?>";

        $(function() {

    var token = "<?php echo $token; ?>",
                cont = 0,
                speakers_content = ['','',''],
                speakers = [
                    $('#speakers-list-container-first'),
                    $('#speakers-list-container-second'),
                    $('#speakers-list-container-third')
                ];

            //$.post( 'http://localhost/api/palestrante/getAll', {token: token},
            $.post( 'http://singep.000webhostapp.com/api/palestrante/getAll', {token: token},
            //$.post( 'http://singep.tecnologia.ws/api/palestrante/getAll', {token: token},
            //$.post( 'https://singep.azurewebsites.net/api/palestrante/getAll', {token: token},
            //$.post( 'http://singep.esy.es/api/palestrante/getAll', {token: token},

                function( rows ) {

                    console.log(rows);

                    var content = '';

                    rows = JSON.parse( rows );

                    for( var i in rows ) {

                        if( rows.hasOwnProperty( i ) ) {

                            if( cont > 2 ){

                                cont = 0;

                            }

                            var row = rows[ i ];

                            content = '';

                            content += '<div class="col-md-12 col-sm-12 col-xs-12 profile_details">';

                            content += '<input type=hidden value="' + row[ "codigo_palestrante" ] + '"/>';

                            content += '<div class="well profile_view" style="width: 100%;" > <div class="col-sm-12">';

                            content += '<div class="right col-xs-12 text-center"> <img style="margin: 0 auto; max-height: 110px;" class="img-circle img-responsive" src="../../api/fotos/' + row["foto"] + '">' + '</div>';

                            content += '<div class="left col-xs-12">';

                            content += '<h2>' + row[ "nome" ] + '</h2>';

                            content += '<p><strong>Cidade/Estado: </strong>' + row[ "cidade" ] + '/' +  row[ "estado" ] + '</p>';

                            content += '<p><strong>Filiação: </strong>' + row[ "filiacao" ] + '</p>';

                            content += '<p><strong>Email: </strong>' + row[ "email" ] + '</p>';

                            content += '<p class="text-justify"><strong>Curriculo: </strong>' + row[ "curriculo" ] + '</p>';

                            content += '<br></div></div>';

                            content += '<div class="col-xs-12 bottom text-center">' +
                                            '<div class="col-xs-12 col-sm-12 emphasis">' +
                                                '<a target="_blank" href="'+ base_url + row["codigo_palestrante"] + '"type="button" class="btn btn-success btn-xs"> <i class="fa fa-edit"></i> Editar</a>' +
                                            '</div>' +
                                        '</div>';

                            content += '</div></div>';

                            speakers_content[ cont ] += content;

                            cont = cont + 1;

                        }

                    }

                    for ( cont = 0; cont < speakers_content.length; cont++ ) {

                        $( speakers[ cont ] ).html( speakers_content[ cont ] );

                    }

                });

        });

    </script>

</html>