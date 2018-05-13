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

        <div class="right_col" role="main">

            <div class="">

                <div class="page-title">

                    <div class="title_left">
                        <h3>Sessões</h3>
                        <br>
                    </div>

                    <div class="title_right">

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group pull-right top_search">
                        </div>

                    </div>

                </div>

                <div class="clearfix"></div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-bars"></i> Agrupamentos <small>Agrupamento de sessões</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>


                        <div class="x_content">

                            <div class="" role="tabpanel" data-example-id="togglable-tabs">

                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#sala" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                                            Sala
                                        </a>
                                    </li>

                                    <li role="presentation" class="">
                                        <a href="#data" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                            Data
                                        </a>
                                    </li>

                                    <li role="presentation" class="">
                                        <a href="#horario" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                            Horário
                                        </a>
                                    </li>
                                </ul>

                                <div id="myTabContent" class="tab-content" >
                                    <div role="tabpanel" class="tab-pane fade active in" id="sala" aria-labelledby="home-tab">

                                        <div style="float: right;">
                                            <select style="width: 150px;" id="list-by-class" class="select2_single form-control" tabindex="-1">
                                                <option></option>
                                                <option value="all">Todas</option>
                                                <?php foreach( $keys_salas as $sala ) {

                                                    echo '<option value="' . $sala . '">' . $sala . '</option>';

                                                }?>
                                            </select>
                                        </div>

                                        <br>
                                        <p class="lead">Agrupamento por sala</p>
                                        <p class="text-justify">
                                            Escolha uma sala no filtro acima, que está localizado no canto superior direito. Se escolher a opção "todas", todos os usuários em todas as salas das sessões serão mostrados. Na tabela abaixo é possível executar uma pesquisa nos dados que estão sendo mostrados, use o campo "buscar" para isto. Mais abaixo, no canto inferior direito os registros são agrupados quando ultrapassam um valor para serem mostrados na mesma página,
                                            navegue se necessário. Os registos podem ser exportados para CSV, Excel, PDF, além de copiados ou impressos.
                                        </p>

                                        <div class="ln_solid"></div>

                                        <table style="margin-top: 20px !important;" id="datatable-responsive-salas" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                                            <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Telefone</th>
                                                <th>Sala</th>
                                            </tr>
                                            </thead>

                                                        <!--tbody>

                                                        </tbody-->
                                        </table>

                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="data" aria-labelledby="profile-tab">

                                        <div style="float: right;">
                                            <select style="width: 150px;" id="list-by-date" class="select2_single form-control" tabindex="-1">
                                                <option></option>
                                                <option value="all">Todas</option>
                                                <?php foreach( $keys_dates as $date ) {

                                                    echo '<option value="' . $date . '">' . $date . '</option>';

                                                }?>
                                            </select>
                                        </div>

                                        <br>
                                        <p class="lead">Agrupamento por data</p>
                                        <p class="text-justify">
                                            Escolha uma data no filtro acima, que está localizado no canto superior direito. Se escolher a opção "todas", todos os usuários em todas as salas das sessões serão mostrados. Na tabela abaixo é possível executar uma pesquisa nos dados que estão sendo mostrados, use o campo "buscar" para isto. Mais abaixo, no canto inferior direito os registros são agrupados quando ultrapassam um valor para serem mostrados na mesma página,
                                            navegue se necessário. Os registos podem ser exportados para CSV, Excel, PDF, além de copiados ou impressos.
                                        </p>

                                        <div class="ln_solid"></div>

                                        <table style="margin-top: 20px !important;" id="datatable-responsive-dates" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                                            <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Telefone</th>
                                                <th>Sala</th>
                                            </tr>
                                            </thead>

                                            <!--tbody>

                                            </tbody-->
                                        </table>

                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="horario" aria-labelledby="profile-tab">

                                        <div style="float: right;">
                                            <select style="width: 150px;" id="list-by-hour" class="select2_single form-control" tabindex="-1">
                                                <option></option>
                                                <option value="all">Todos</option>
                                                <?php foreach( $hoursIntervalsKeys as $hourInterval ) {

                                                    echo '<option value="' . $hourInterval . '">' . $hourInterval . '</option>';

                                                }?>
                                            </select>
                                        </div>

                                        <br>
                                        <p class="lead">Agrupamento por horário</p>
                                        <p class="text-justify">
                                            Escolha um intervalo de horário no filtro acima, que está localizado no canto superior direito. Se escolher a opção "todos", todos os usuários em todas as salas das sessões serão mostrados. Na tabela abaixo é possível executar uma pesquisa nos dados que estão sendo mostrados, use o campo "buscar" para isto. Mais abaixo, no canto inferior direito os registros são agrupados quando ultrapassam um valor para serem mostrados na mesma página,
                                            navegue se necessário. Os registos podem ser exportados para CSV, Excel, PDF, além de copiados ou impressos.
                                        </p>

                                        <div class="ln_solid"></div>

                                        <table style="margin-top: 20px !important;" id="datatable-responsive-hours" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                                            <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Telefone</th>
                                                <th>Sala</th>
                                            </tr>
                                            </thead>

                                            <!--tbody>

                                            </tbody-->
                                        </table>

                                    </div>
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

<script type="text/javascript">

    var salas = <?php echo json_encode( $salas ); ?>,
        dates = <?php echo json_encode( $dates ); ?>,
        hoursIntervals = <?php echo json_encode( $hoursIntervals ); ?>;

    $(function() {


        // Configuring all datatables

        $('.table').DataTable({

            'order': [[ 0, 'asc' ]],

            "language": {
                emptyTable : "Tabela vazia, escolha algum valor no filtro",
                zeroRecords: "Nenhum resultado encontrado",
                lengthMenu : "Linhas _MENU_",
                search: 'Buscar: ',
                info : "Mostrando _START_ de _END_ de _TOTAL_ linhas",
                infoEmpty : "Mostrando 0 de 0 de 0 linhas",
                paginate: {
                    first:    "Primeira",
                    previous: "Anterior",
                    next:     "Próxima",
                    last:     "Última"
                }
            },

            dom: "Bfrtip",

            buttons: [

                {
                    extend: "csv",
                    className: "btn-sm"
                },

                {
                    extend: 'copy',
                    className: "btn-sm"
                },

                {
                    extend: 'excel',
                    className: "btn-sm"
                },

                {
                    extend: 'pdf',
                    className: "btn-sm"
                },
                {
                    extend: 'print',
                    className: "btn-sm"
                }

            ]

        });

        var datatable_responsive_salas = $('#datatable-responsive-salas').DataTable(),
            datatable_responsive_dates = $('#datatable-responsive-dates').DataTable(),
            datatable_responsive_hours = $('#datatable-responsive-hours').DataTable();

        $('#list-by-class').select2({

            placeholder: " Escolha uma sala",

            allowClear: true

        }).on( 'change', function() {

            var data = $( this).select2( 'data'),
                key = data[ 0 ][ 'text' ],
                rows = salas[ key ],
                size = salas[ key ].length;

            datatable_responsive_salas.clear();

            for( var i = 0; i < size ; i = i + 1 ) {

                var row = rows[ i ];

                datatable_responsive_salas.row.add( [ row[ "nome" ],
                                                      row[ "email" ],
                                                      row[ "telefone" ],
                                                      row[ "sala" ] ] ).draw( false );

            }

        });

        $('#list-by-date').select2({

            placeholder: " Escolha uma data",

            allowClear: true

        }).on( 'change', function() {

            var data = $( this ).select2( 'data' ),
                key = data[ 0 ][ 'text' ],
                rows = dates[ key ],
                size = dates[ key ].length;

            datatable_responsive_dates.clear();

            for( var i = 0; i < size ; i = i + 1 ) {

                var row = rows[ i ];

                datatable_responsive_dates.row.add( [ row[ "nome" ],
                                                      row[ "email" ],
                                                      row[ "telefone" ],
                                                      row[ "sala" ] ] ).draw( false );

            }

        });

        $('#list-by-hour').select2({
            placeholder: " Escolha um horário",
            allowClear: true
        }).on( 'change', function() {

            var data = $( this ).select2( 'data' ),
                key = data[ 0 ][ 'text' ],
                rows = hoursIntervals[ key ],
                size = hoursIntervals[ key ].length;

            datatable_responsive_hours.clear();

            for( var i = 0; i < size ; i = i + 1 ) {

                var row = rows[ i ];

                datatable_responsive_hours.row.add( [ row[ "nome" ],
                                                      row[ "email" ],
                                                      row[ "telefone" ],
                                                      row[ "sala" ] ] ).draw( false );

            }

        });

    });

</script>

</html>