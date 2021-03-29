<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Share-it Login </title>
    <!-- Bootstrap -->
    <link href="{{URL::asset('templates/gentelella/back-end/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{URL::asset('templates/gentelella/back-end/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{URL::asset('templates/gentelella/back-end/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{URL::asset('templates/gentelella/back-end/vendors/animate.css/animate.min.css')}}" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="{{URL::asset('templates/gentelella/back-end/build/css/custom.min.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <?php include(public_path('scripts/public.php')) ?>
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                {!! Form::open(['url' => '/user/login','method'=>'post','id'=>'Login']) !!}
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" name="name" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        {!! Form::submit('Login',['onclick'=>"sendRequest('Login','success','login')",'class'=>'btn btn-default submit']) !!}
                        <span class="loader"></span>
                        <a class="reset_pass" href="#">Lost your password?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="#signup" class="to_register"> Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Share-it for upkey</h1>
                            <p>©2016 All Rights Reserved. Upkey! </p>
                        </div>
                    </div>
                {!! Form::close() !!}
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                {!! Form::open(['url' => '/user/register','method'=>'post','id'=>'Register']) !!}
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" name="name" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                    </div>

                    <div>
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required="" />
                    </div>

                    <div>
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required="" />
                    </div>

                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required="" />
                    </div>
                    <div>
                        {!! Form::submit('Signup',['onclick'=>"sendRequest('Register','success','register')",'class'=>'btn btn-default submit']) !!}
                        <span class="loader"></span>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Share-it for upkey</h1>
                            <p>©2016 All Rights Reserved. Upkey! </p>
                        </div>
                    </div>
                {!! Form::close() !!}
            </section>
        </div>
    </div>
</div>

@include('templates.gentelella.back-end.layouts.modal')

<script>
    function login(postRequest)
    {
        postRequest.done(function(jsonData){
            if(!jsonData.status)
            {
                showError(jsonData);
            }else
            {
                showModalMessage('success','Waiting The screen is automatically redirected to the control panel.');
                setTimeout(function () {
                    redirect("{{url('admin/panel')}}")
                },2000);
            }
        })
    }

    function register(postRequest)
    {
        postRequest.done(function(jsonData){
            if(!jsonData.status)
            {
                showError(jsonData);
            }else
            {
                showModalMessage('success','Registration has been successfully. redirected to the dashboard automatically');
                setTimeout(function () {
                    redirect("{{url('admin/panel')}}")
                },2000);
            }
        })
    }

</script>
</body>
</html>
