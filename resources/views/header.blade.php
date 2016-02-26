<!--horizontal navigation menu-->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">My Shop</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contacts</a></li>

            @if(Session::has('admin'))
            <li><a href="AddProduct">Add Product</a></li>
            @endif

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><img src="../products/cart.jpg"  width="30" height="30"><span class="badge"><?php echo Cart::count(); ?></span></a></li>
            <li><a href="#">
                    @if(Session::has('firstName'))
                    {{ Session::get('firstName')}}
                    @endif
                    @if(Session::has('lastName'))
                    {{ Session::get('lastName')}}
                    @endif
                    @if(Session::has('image'))
                    <img src="../{{Session::get('image')}}" width="30" height="30"/>
                    @endif
                </a></li>
            <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
            <li><a href="logOut"><span class="glyphicon glyphicon-log-in"></span> LogOut</a></li>
        </ul>
    </div>
</nav>
