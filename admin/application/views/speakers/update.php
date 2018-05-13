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

        <!-- page content -->

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Palestrantes</h3>
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

                                <?php echo form_open_multipart( 'speakers/updateSpeaker', array( 'id' => 'form-update-speaker', 'class' => 'form-horizontal form-label-left') )  ?>

                                <?php foreach($speakers as $speaker) ?>

                                <div class="form-group">

                                    <div class="col-xs-12 col-sm-8">

                                        <div class="form-image-container">

                                            <img class="img-responsive" id="form-image-edit" alt="Picture" src="<?php echo base_url()."assets/images/picture.png"; ?>">

                                        </div>

                                    </div>

                                    <div class="col-xs-12 col-sm-4">

                                        <button id="load-image-cropp" class="center btn btn-success">Carregar foto</button>

                                        <div id="result-cropp" class="cropper-bg image-preview-container">
                                            <img id="cropped-image-result" src="../../../api/fotos/<?php echo $speaker->foto; ?>" />
                                        </div>

                                        <div class="text-center">Preview</div>

                                        <button id="btn-cropp" class="center-second-btn btn btn-primary">Fazer Crop</button>

                                    </div>

                                    <div id="image-upload_error" class="form-error-message">
                                    </div>

                                    <input id="speakers-image-upload" name="speakers-image-upload" type="file" />

                                    <input value="<?php echo $speaker->codigo_palestrante; ?>" name="codigo_palestrante" type="hidden" />

                                    <input value="<?php echo $speaker->foto; ?>" id="img-name" type="hidden" />

                                </div>

                                <div class="ln_solid"></div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?php echo $speaker->nome; ?>" maxlength="100" type="text" name="nome" id="nome" class="form-control col-md-7 col-xs-12">
                                        <div id="nome_error" class="form-error-message">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cidade">Cidade <span class="required">*</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?php echo $speaker->cidade; ?>" maxlength="100" type="text" id="cidade" name="cidade" class="form-control col-md-7 col-xs-12">
                                        <div id="cidade_error" class="form-error-message">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado">Estado <span class="required">*</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?php echo $speaker->estado; ?>" maxlength="100" type="text" id="estado" name="estado" class="form-control col-md-7 col-xs-12">
                                        <div id="estado_error" class="form-error-message"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?php echo $speaker->email; ?>" maxlength="100" type="text" id="email" name="email" class="form-control col-md-7 col-xs-12">
                                        <div id="email_error" class="form-error-message">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="filiacao">Filiação <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?php echo $speaker->filiacao; ?>" maxlength="200" type="text" id="filiacao" name="filiacao" class="form-control col-md-7 col-xs-12">
                                        <div id="filiacao_error" class="form-error-message"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="curriculo">Currículo <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="curriculo" id="curriculo" class="form-control" rows="3"><?php echo $speaker->curriculo; ?></textarea>
                                        <div id="curriculo_error" class="form-error-message"></div>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button id="clean-form-speakers" class="btn btn-primary">Limpar formulário</button>
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

        function getRoundedCanvas(sourceCanvas) {
            var canvas = document.createElement('canvas');
            var context = canvas.getContext('2d');
            var width = sourceCanvas.width;
            var height = sourceCanvas.height;
            canvas.width = width;
            canvas.height = height;
            context.beginPath();
            context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI);
            context.strokeStyle = 'rgba(0,0,0,0)';
            context.stroke();
            context.clip();
            context.drawImage(sourceCanvas, 0, 0, width, height);
            return canvas;
        }

        $(function() {

            var $image = $('#form-image-edit');
            var $button = $('#btn-cropp');
            var cropImage;
            var croppable = false;

            $( '#load-image-cropp').on('click', function( e ) {

                e.preventDefault();

                $('#speakers-image-upload').click();

            });

            /* Image Loader */

            $( '#speakers-image-upload' ).on( 'change', function( evt ) {

                var tgt = evt.target || window.event.srcElement,
                    files = tgt.files;

                var fr = new FileReader();

                if ( FileReader && files && files.length ) {

                    fr.onload = function () {

                        $image.cropper( 'replace', fr.result );
                    };

                }

                fr.readAsDataURL( files[0] );

            });

            $( '#clean-form-speakers').on('click', function( e ) {

                e.preventDefault();

                $('#nome').val('');

                $('#filiacao').val('');

                $('#cidade').val('');

                $('#estado').val('');

                $('#curriculo').val('');

            });

            $image.cropper({
                aspectRatio: 1,
                viewMode: 1,
                responsive: true,
                resizable: false,
                built: function () {
                    croppable = true;
                }
            });

            $button.on('click', function ( e ) {

                e.preventDefault();

                var croppedCanvas;
                var roundedCanvas;
                if (!croppable) {
                    return;
                }
                // Crop
                croppedCanvas = $image.cropper('getCroppedCanvas');
                // Round
                roundedCanvas = getRoundedCanvas(croppedCanvas);

                cropImage = roundedCanvas.toDataURL();

                // Show
                $('#cropped-image-result')[0].src = cropImage;

            });

            // Form new speaker

            $( "#form-update-speaker").on( 'submit', function( e ) {

                e.preventDefault();

                var formData = new FormData( this );

                if( cropImage ) {

                    var blobBin = atob( cropImage.split( ',' )[ 1 ] );

                    var array = [];

                    for ( var i = 0; i < blobBin.length; i++ ) {

                        array.push( blobBin.charCodeAt( i ) );

                    }

                    var file = new Blob( [ new Uint8Array( array ) ], {type: 'image/png'} );

                    formData.append( 'image-upload', file );

                } else {

                    formData.append( 'image-upload-before', $( '#img-name' ).val() );

                }

                $.ajax({

                    url: '<?php echo base_url('speakers/updateSpeaker'); ?>',
                    type: "POST",
                    data:  formData,
                    mimeType:"multipart/form-data",
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

                            $( '#curriculo_error').html( 'Usuário atualizado com sucesso!' );

                        }

                    }

                });


            });

        });


    </script>


</body>
</html>