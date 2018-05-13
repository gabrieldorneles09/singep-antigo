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
    <!-- Animate.css -->
    <link href="<?php echo base_url()."assets/vendors/animate.css/animate.min.css" ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()."assets/build/css/custom.min.css" ?>" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <?php echo form_open( '/', array( 'id' => 'login-form') )  ?>
                    <h1>Login</h1>
                    <div>
                        <input id="email" name="email" type="text" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input id="documento" name="documento" type="password" class="form-control" placeholder="Documento" required="" />
                    </div>

                    <input type="hidden" value="true" />

                    <input id="form-token" name="token" type="hidden" />

                    <input id="form-username" name="username" type="hidden" />

                    <input id="form-admin" name="adm" type="hidden" />

                    <div id="form-login-error">
                    </div>

                    <br>

                    <div>
                        <button type="submit" class="btn btn-success">Login</button>
                        <!--a class="btn btn-default submit" href="index.html">Log in</a>
                        <a class="reset_pass" href="#">Lost your password?</a-->
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <!--p class="change_link">New to site?
                            <a href="#signup" class="to_register"> Create Account </a>
                        </p-->

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            ©2016 Singep - by <a target="_blank" href="http://www.uninove.br/">Uninove</a>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form>
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="index.html">Submit</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Singep</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>

<script type="text/javascript" src="<?php echo base_url()."assets/vendors/jquery/dist/jquery.min.js" ?>"></script>
<script type="text/javascript" src="<?php echo base_url()."assets/vendors/jquery-cookie/jquery.cookie.js" ?>"></script>
<script type="text/javascript">


    $( '#login-form').on('submit', function( e ) {
        
        e.preventDefault();
        
        //$.post( 'http://singep.tecnologia.ws/api/api/getLogin',
        $.post( 'http://singep.000webhostapp.com/api/api/getLogin',
        //$.post( 'http://localhost/api/api/getLogin',

                {login: true, email: $('#email').val(), documento: $('#documento').val()},

            function( data ) {

                data = JSON.parse( data );

                if( data["token"] && ( data["adm"] != "0" ) ) {

                    $("#form-token").val( data["token"] );

                    $("#form-username").val( data["nome"] );

                    $("#form-admin").val( data["adm"] );

                    $.ajax({

                        url: '<?php echo base_url('login'); ?>',

                        type: 'POST',

                        dataType: 'json',

                        data: $('#login-form').serialize(),

                        success: function( data ) {

                            if( data ){

                               window.location.href = '/admin';

                            }

                        }

                    });

                } else {

                    $('#form-login-error').html('Usuário ou senha inválidos.');

                }

        });

    })

</script>

</html>

