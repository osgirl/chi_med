<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Recomed</title>

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
          padding: 40px 40px 40px 40px;
        }
        page[size="A4"] {
          width: 28cm;
        }
        .print-banner {
          text-align: center;
        }
        .print-btn {
          -webkit-transition-duration: 0.4s; /* Safari */
          transition-duration: 0.4s;
          background-color: white;
          color: black;
          border: 2px solid #4CAF50; /* Green */
          padding: 10px 18px;
          font-size: 16px;
        }
        .print-btn:hover {
          background-color: #4CAF50; /* Green */
          color: white;
        }
        .print-back-btn {
          -webkit-transition-duration: 0.4s; /* Safari */
          transition-duration: 0.4s;
          background-color: white;
          color: black;
          border: 2px solid #FFA533; /* Orange */
          padding: 10px 18px;
          font-size: 16px;
        }
        .print-back-btn:hover {
          background-color: #FFA533; /* Orange */
          color: white;
        }
        @media print {
          body, page {
            margin: 0;
            padding-left: 0px;
            box-shadow: 0;
            font-size: 14pt;
          }
          .no-print, .no-print *
          {
            display: none !important;
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
<body>
  <div class="no-print">
    <div class="print-banner">
      <h1>Print</h1>
      <a href="{{ url('/patient/'.$record->patient_id)}}" class="print-back-btn">
        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
        Back
      </a>
      <button type="button" onclick="print();" class="print-btn" name="button">Print</button>
    </div>
  </div>
  @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>

</body>
</html>
