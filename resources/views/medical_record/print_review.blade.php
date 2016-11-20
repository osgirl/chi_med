@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="well well- sm col-sm-12 hidden-print">
        <div class="col-sm-3">
          <a href="{{ url('/patient/'.$record->patient_id)}}" class="btn btn-warning btn-block">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Back
          </a>
        </div>
        <div class="col-sm-3">
          <button type="button" onclick="print();" class="btn btn-primary btn-block" name="button">Print</button>
        </div>
      </div>
        <div class="col-sm-12">
          <page size="A4">
            <h4>{{ env('APP_NAME', 'Recomed') }}</h4>
            <table border="1">
              <tr class="warning">
                <th width="80px">
                  <p>
                    {{ $record->surname}} {{$record->last_name}}
                  </p>
                </th>
                <th width="125px">
                  <p>
                    DOB : {{ date('d-m-Y', strtotime($record->DOB))}}
                  </p>
                </th>
                <th width="80px">
                  <p>
                    Gender : {{ $record->gender }}
                  </p>
                </th>
                <td width="125px">

                </td>
              </tr>
              <tr>
                <td class="warning"><p>Summary</p></td>
                <td colspan="3"><p>{{ $record->summary}}</p></td>
              </tr>
              <tr>
                <td class="warning"><p>Investigation</p></td>
                <td colspan="3"><p>{{ $record->investigation}}</p></td>
              </tr>
              <tr>
                <td class="warning"><p>Outcomes</p></td>
                <td colspan="3"><p>{{ $record->outcomes}}</p></td>
              </tr>
              <tr>
                <td class="warning"><p>Differential Diagnosis</p></td>
                <td colspan="3"><p>{{ $record->differential_diagnosis}}</p></td>
              </tr>
              <tr>
                <td class="warning"><p>Treatment</p></td>
                <td colspan="3"><p>{{ $record->treatment}}</p></td>
              </tr>
              <tr>
                <td class="warning"><p>Discussion</p></td>
                <td colspan="3"><p>{{ $record->discussion}}</p></td>
              </tr>
              <tr style="height:75px;">
                <td class="warning">
                  Signature
                </td>
                <td>

                </td>
                <td class="warning">
                  Date
                </td>
                <td>

                </td>
              </tr>
            </table>
          </page>
        </div>
    </div>
</div>
@endsection
