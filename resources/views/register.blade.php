<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<br/>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
    {!! Form::open(array('route' => 'register', 'files' => true,'class'=>'form-horizontal')) !!}
    <fieldset>
        <div id="legend">
            <legend class=""><h1>Register</h1></legend>
        </div>
        <div class="control-group">
            <!-- Username -->
            <label class="control-label"  for="firstName">First Name:</label>
            <div class="controls">
                {{ Form::text('firstName')}}
                <p class="text-danger">{{ $errors->first('firstName') }}</p>
            </div>
        </div>


        <div class="control-group">
            <!-- Username -->
            <label class="control-label"  for="lastName">Last Name:</label>
            <div class="controls">
                {{ Form::text('lastName') }}
                <p class="text-danger">{{ $errors->first('lastName') }}</p>
            </div>
        </div>

        <div class="control-group">
            <!-- E-mail -->
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
                {{ Form::text('email') }}
                <p class="text-danger">{{ $errors->first('email') }}</p>
            </div>
        </div>

        <div class="control-group">
            <!-- Password-->
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                {{Form::password('password') }}
                <p class="text-danger">{{ $errors->first('password') }}</p>
            </div>
        </div>



        <div class="control-group">
            <!-- Password -->
            <label class="control-label"  for="password_confirm">Password (Confirm)</label>
            <div class="controls">
                {{ Form::password('cPassword') }}
                <p class="text-danger">{{ $errors->first('cPassword') }}</p>
            </div>
        </div>

        <div class="control-group">
            <!-- Password -->
            <label class="control-label"  for="image">Upload Image</label>
            <div class="controls">
                {{ Form::file('image') }}
                <p class="text-danger">{{ $errors->first('image') }}</p>
            </div>
        </div>


        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                {{ Form::submit("Submit") }}
            </div>
        </div>
    </fieldset>
            {!! Form::close() !!}
            </div>
        </div>
</div>

</body>
</html>
