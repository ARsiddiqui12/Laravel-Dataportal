<!DOCTYPE html>
<head>
<title>DataPortal</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{ asset('assets/css/style.css') }}" rel='stylesheet' type='text/css' />
<link href="{{ asset('assets/css/style-responsive.css') }}" rel="stylesheet"/>
<!-- font CSS -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{ asset('assets/css/font.css') }}" type="text/css"/>
<link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{ asset('assets/js/jquery2.0.3.min.js') }}"></script>
</head>
<body>
<div class="log-w3">

<div class="w3layouts-main">
    <h2 style="text-transform:capitalize;color:white;font-weight: bold;">DataPortal</h2>

     @if ($errors->has('email'))
     
         <div class="alert alert-danger"> {{ $errors->first('email') }}</div>
     
     @endif

    @if ($errors->has('password'))
                                    
        <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                                   
    @endif

         <form class="form-horizontal" method="POST" action="{{ route('login') }}">
         {{ csrf_field() }}
            
         <input id="email" type="email" class="ggg" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>

                               
        <input id="password" type="password" class="ggg" placeholder="Password" name="password" required>



            <span><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me</span>
           
                <div class="clearfix"></div>
                <input type="submit" value="Login" name="login">
        </form>
        
</div>

</div>
<script src="{{ asset('assets/js/bootstrap.') }}"></script>
<script src="{{ asset('assets/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{ asset('assets/js/jquery.scrollTo.js') }}"></script>
<script src="{{ asset('public/js/app.js') }}"></script>
</body>
</html>
