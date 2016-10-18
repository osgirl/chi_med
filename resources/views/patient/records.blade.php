@extends('layouts.app')

@section('content')
<script type="text/javascript">
function searchPatient(){
  var id = document.getElementById('select_patient_code').value;
  window.location = "{{ url('/patient') }}/"+id;

}
</script>
<div class="container">
    <div class="row">
      <div class="well well-sm col-sm-12">
        <div class="col-sm-3">
          <a href="{{ url('/home') }}" class="btn btn-warning btn-block">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Back
          </a>
        </div>
      </div>
      <div class="col-sm-10 col-sm-offset-1">
        <div class="col-sm-12" align="center">
          @if($type == "acc")
          <h3>ACC Patients</h3>
          @elseif($type == "nonacc")
          <h3>Non-ACC Patients</h3>
          @endif
        </div>
        <div class="col-sm-12 well well-sm">
          <div class="col-sm-6 col-sm-offset-3">
            <div class="col-sm-8">
              <select class="form-control" id="select_patient_code">
                @foreach($records as $r)
                <option value="{{$r->id}}">{{ $r->patient_code }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-4">
              <button type="button" class="btn btn-block btn-primary" name="button" onclick="searchPatient();">Search</button>
            </div>
          </div>
        </div>
          @if(count($records)>0)
          <table class="table table-bordered table-condensed table-hover">
          <tr class="info">
            <th>Patient Code</th>
            <th>Surame</th>
            <th>Last Name</th>
            <th>Cell Phone</th>
            <th>Date of Birth</th>
            <th>Gender</th>
          </tr>
          @foreach($records as $r)
          <tr>
            <td><a type="button" class="btn btn-block btn-info" href="{{ url('/patient/'.$r->id) }}">{{ $r->patient_code}}</a></td>
            <td>{{ $r->surname}}</td>
            <td>{{ $r->last_name}}</td>
            <td>{{ $r->cell_phone}}</td>
            <td>{{ $r->DOB}}</td>
            <td>{{ $r->gender}}</td>
          </tr>
          @endforeach
          </table>
          @else
          <h3>No Data Yet!</h3>
          @endif
      </div>
    </div>
</div>

@endsection
