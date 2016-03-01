<!--horizontal navigation menu-->
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <style>

        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            width: 85%;
            margin: auto;
        }
        body { padding-bottom: 70px; }
    </style>

</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">My Shop</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="home">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contacts</a></li>

            <li><a href="AddProduct">
@if (auth()->check())
    @if (auth()->user()->isAdmin())Add Product @endif
@endif

                 </a></li>
            </ul>

          <ul class="nav navbar-nav navbar-right">
              <li><a href="cart"><img src="../products/cart.jpg" width="30" height="30"><span class="badge"><?php echo Cart::count(); ?></span></a></li>
              <li><a href="#">
                      {{ Auth::user()->first_name }}
                     </a>
              <li><a href="#">
                      {{ Auth::user()->last_name }}
                  </a>
                  </li>
                   <li><a>
                      <img src="../uploads/{{ Auth::user()->image_name }}" width="30" height="30"/>

                  </a></li>
              <li><a href="logOut"><span class="glyphicon glyphicon-log-in"></span> LogOut</a></li>
          </ul>
      </div>
  </nav>

  @yield('main_content');

  <nav class="navbar navbar-default navbar-bottom" role="navigation">
      <div class="container">
          <h6>Copyright © 2016 SoftCode. All rights reserved.</h6>
      </div>
  </nav>


  </body>
  </html>

