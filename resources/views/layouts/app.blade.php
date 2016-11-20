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
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <!--Animated CSS-->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!--Flipclock-->
    <link rel="stylesheet" href="{{ asset('css/flipclock.css') }}">
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
          padding: 30px 30px 30px 30px;
        }
        page[size="A4"] {
          width: 29cm;
          height: 29.7cm;
        }
        page[size="A4"][layout="portrait"] {
          width: 29.7cm;
          height: 21cm;
        }
        @media print {
          body, page {
            margin: 0;
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
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
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
                <ul class="nav navbar-nav navbar-right">
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
            </div>
        </div>
    </nav>
    <div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
      <div class="row">
        <div class="col-md-12">
          <div id="pusher"></div>
            @if(Session::has('message'))
            <div class="alert alert-info">
              {{Session::get('message')}}
            </div>
            @endif
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          @yield('content')
        </div>
      </div>
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript">
    function deleteBtn(button){
      swal({
        title:"Are you sure?",
        text: "You will not be able to recover !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false },
        function(){
          button.form.submit();
          swal("Deleted!", "", "success");
        });
    }
    function saveBtn(button){
      swal({
        title:"Success",
        text: "Updated !",
        type: "success",
      },function(){
        button.form.submit();
      });
    }
    function warningBtn(link){
      swal({
        title:"Warning !",
        text: "Are you sure ?",
        type: "warning",
        showCancelButton: true,
      },function(){
        window.location.href = link;
      });
    }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!--Flipclock-->
    <script src="{{asset('js/flipclock.min.js')}}"></script>
    <script type="text/javascript">
      var clock;
      $(document).ready(function() {
				var date = new Date();
				clock = $('.clock').FlipClock(date, {
          clockFace: 'TwentyFourHourClock'
				});
			});
    </script>
    <script type="text/javascript">
      $('select').select2();
    </script>
    <script type="text/javascript">
      var d = new Date();
      var weekday = new Array(7);
      weekday[0]=  "Sunday";
      weekday[1] = "Monday";
      weekday[2] = "Tuesday";
      weekday[3] = "Wednesday";
      weekday[4] = "Thursday";
      weekday[5] = "Friday";
      weekday[6] = "Saturday";
      document.getElementById('weekday_now').innerHTML = weekday[d.getDay()];
      document.getElementById('date_now').innerHTML = d.getDate()+"-"+d.getMonth(d.setMonth(d.getMonth()+1))+"-"+d.getFullYear();
    </script>
</body>
</html>
