<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Recomed</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- MetisMenu CSS -->
    <link href="{{ asset('css/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{ asset('css/timeline.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/startmin.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('css/morris.css')}}" rel="stylesheet">

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <!--Animated CSS-->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!--css reset-->
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset-context/cssreset-context-min.css">

    <style>
        body {
            font-family: 'Lato';
        }
        th{
            text-align: center;
        }
        .fa-btn {
            margin-right: 6px;
        }
        page {
          background: white;
          display: block;
          margin: 0 auto;
          margin-bottom: 0.5cm;
          box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
          padding: 25px 25px 25px 25px;
        }
        page[size="A4"] {
          width: 29cm;
          height: 29.7cm;
        }
        @media print {
          body, page {
            margin: 0;
            padding-left: 0;
            box-shadow: 0;
            font-size: 14pt;
          }
          table, td, th {
            border: 1px solid black;
            border-collapse: collapse;
          }
          th{
              background-color: #E6E6E6 !important;
              padding: 2px 2px 2px 2px;
              text-align: center;
              font-family:'Times New Roman',Times,serif;
          }
          td {
            vertical-align: center;
            padding: 2px 2px 2px 2px;
            padding-left: 10px;
            font-family:'Times New Roman',Times,serif;
          }
          .warning{
            background-color: #E6E6E6 !important;
            text-align: center;
          }
        }
    </style>
</head>
<body id="app-layout">
  <!-- Page Content -->
  <div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="navbar-header">
          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/') }}">
              Recomed
          </a>
      </div>
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
              <li><a href="{{ url('/home') }}">Home</a></li>
              <!--<li><a href="{{ url('/test') }}">test</a></li>-->
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right navbar-top-links">
              <!-- Authentication Links -->
              @if (Auth::guest())
                  <li><a href="{{ url('/login') }}">Login</a></li>
                  <li><a href="{{ url('/register') }}">Register</a></li>
              @else
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                          <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                      </ul>
                  </li>
              @endif
          </ul>
          <!-- Sidebar -->
          <div class="navbar-default sidebar" role="navigation">
              <div class="sidebar-nav navbar-collapse">
                  <ul class="nav" id="side-menu">
                    <li align="center">
                      <div class="col-sm-12 alert alert-info">
                        <h3 class="animated fadeIn">Hello @if (!Auth::guest()) {{ Auth::user()->name }} @endif</h3>
                      </div>
                      <h4 class="animated fadeIn" id="date_now"></h4>
                      <h4 class="animated fadeIn" id="weekday_now"></h4>
                      <h4 class="animated fadeIn" id="jsclock"></h4>
                    </li>
                  </ul>
              </div>
          </div>
      </div>
    </nav>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
          @if(Session::has('message'))
          <div class="row">
            <div class="col-sm-12">
              <div id="pusher"></div>
                <div class="alert alert-info">
                  {{Session::get('message')}}
                </div>
            </div>
          </div>
          @endif

          @yield('content')
        </div>
    </div>
  </div>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js')}}"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('js/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('js/startmin.js')}}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="{{ asset('js/jsclock-0.8.min.js')}}"></script>

    <script type="text/javascript">
      $('select').select2();
      $(document).ready(function(){
         $('#jsclock').jsclock();
      });
    </script>
</body>
</html>
