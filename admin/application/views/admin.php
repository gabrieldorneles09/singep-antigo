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
    <!-- iCheck -->
    <link href="<?php echo base_url()."assets/vendors/iCheck/skins/flat/green.css" ?>" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url()."assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" ?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url()."assets/vendors/jqvmap/dist/jqvmap.min.css" ?>" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()."assets/build/css/custom.min.css" ?>" rel="stylesheet">
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
</div>

<!-- jQuery -->
<script src="<?php echo base_url()."assets/vendors/jquery/dist/jquery.min.js" ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url()."assets/vendors/bootstrap/dist/js/bootstrap.min.js" ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url()."assets/vendors/fastclick/lib/fastclick.js" ?>"></script>
<!-- NProgress -->
<script src="<?php echo base_url()."assets/vendors/nprogress/nprogress.js" ?>"></script>
<!-- Chart.js -->
<script src="<?php echo base_url()."assets/vendors/Chart.js/dist/Chart.min.js" ?>"></script>
<!-- gauge.js -->
<script src="<?php echo base_url()."assets/vendors/gauge.js/dist/gauge.min.js" ?>"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo base_url()."assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js" ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url()."assets/vendors/iCheck/icheck.min.js" ?>"></script>
<!-- Skycons -->
<script src="<?php echo base_url()."assets/vendors/skycons/skycons.js" ?>"></script>
<!-- Flot -->
<script src="<?php echo base_url()."assets/vendors/Flot/jquery.flot.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/Flot/jquery.flot.pie.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/Flot/jquery.flot.time.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/Flot/jquery.flot.stack.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/Flot/jquery.flot.resize.js" ?>"></script>
<!-- Flot plugins -->
<script src="<?php echo base_url()."assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/flot-spline/js/jquery.flot.spline.min.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/flot.curvedlines/curvedLines.js" ?>"></script>
<!-- DateJS -->
<script src="<?php echo base_url()."assets/vendors/DateJS/build/date.js" ?>"></script>
<!-- JQVMap -->
<script src="<?php echo base_url()."assets/vendors/jqvmap/dist/jquery.vmap.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js" ?>"></script>
<script src="<?php echo base_url()."assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js" ?>"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url()."assets/src/js/moment/moment.min.js" ?>"></script>
<script src="<?php echo base_url()."assets/src/js/datepicker/daterangepicker.js" ?>"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo base_url()."assets/build/js/custom.min.js" ?>"></script>

</body>
</html>
