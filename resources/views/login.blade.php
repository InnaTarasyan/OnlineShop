
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <style>
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            width: 30%;
            margin: auto;
        }
    </style>
</head>
<body>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Login to <b>My Shop</b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-6">
                    <div class="well">
                        {!! Form::open(array('route' => 'login')) !!}
                            <div class="form-group">
                                <label for="email" class="control-label">Email Address</label>
                                {!! Form::text('email') !!}
                                <!--<span class="help-block"></span>-->
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                {!! Form::password('password')!!}
                               <!-- <span class="help-block"></span>-->
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            </div>
                            <div id="loginErrorMsg" class="alert alert-error hide">Wrong username or password</div>
                            <br/>
                        <div class="bg-danger">
                            
                        </div>

                        {!! Form::submit("Submit") !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-xs-6">
                    <p class="lead">Register now for <span class="text-success">FREE</span></p>
                    <ul class="list-unstyled" style="line-height: 2">
                        <li><span class="fa fa-check text-success"></span> See available products</li>
                        <li><span class="fa fa-check text-success"></span> Shipping is always free</li>
                        <li><span class="fa fa-check text-success"></span> Save your favorites</li>
                        <li><span class="fa fa-check text-success"></span> Free Registration</li>

                    </ul>
                    <p><a href="register" class="btn btn-info btn-block">Yes please, register now!</a></p>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>