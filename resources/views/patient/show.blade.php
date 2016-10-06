@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-3 col-sm-offset-1">
        @if($patient->acc == 1)
        <a href="{{ url('/patient_index/acc' ) }}" class="btn btn-warning btn-block">
        @else
        <a href="{{ url('/patient_index/nonacc' ) }}" class="btn btn-warning btn-block">
        @endif
          <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
          Back
        </a>
      </div>
      <div class="col-sm-3">
        <a href="{{ url('patient/'.$patient->id.'/edit' ) }}" class="btn btn-info btn-block">
          Edit Patient Informations
        </a>
      </div>
      <div class="col-sm-3">
        <form class="form-horizontal" action="{{ url('/patient/'.$patient->id)}}" method="post" role="form">
        {!! csrf_field() !!}
          <input type="hidden" name="_method" value="delete" />
          <input type="submit" class="btn btn-danger btn-block" value="Delete Patient">
        </form>
      </div>
      <div class="col-sm-10 col-sm-offset-1">
        @if(count($patient)>0)
        <div class="col-sm-3">
          <a href="{{ url('/medical_record/create/'.$patient->id ) }}" class="thumbnail">
            <img src="{{ url('/img/add.png') }}" alt="...">
          </a>
        </div>
        <div class="col-sm-9">
          <table class="table table-hover">
            <tr class="info">
              <th colspan="2">{{ $patient->surname}}  {{ $patient->last_name}}</th>
            </tr>
            <tr>
              <td class="col-sm-2 warning">Patient Code:</td>
              <td class="col-sm-4">{{ $patient->patient_code}}</td>
            </tr>
            @if($patient->acc == 1)
            <tr>
              <td class="warning">ACC</td>
              <td>YES</td>
            </tr>
            <tr>
              <td class="warning">ACC Number</td>
              <td>{{ $patient->acc_number }}</td>
            </tr>
            @else
            <tr>
              <td class="warning">ACC</td>
              <td>NO</td>
            </tr>
            @endif
            <tr>
              <td class="warning">Birthday:</td><td>{{ date('d-m-Y', strtotime($patient->DOB)) }}</td>
            </tr>
            <tr>
              <td class="warning">Gender:</td><td>{{ $patient->gender}}</td>
            </tr>
            <tr>
              <td class="warning">Phone:</td><td>{{ $patient->phone}}</td>
            </tr>
            <tr>
              <td class="warning">Cell Phone:</td><td>{{ $patient->cell_phone}}</td>
            </tr>
          </table>
          @endif
        </div>
        <table class="table table-bordered table-condensed table-hover">
          @if(count($records)>0)
          <tr class="info">
            <th></th>
            <th>Treatment Number</th>
            <th>Main Complaint</th>
            <th>Create Date</th>
            <th></th>
          </tr>
          @foreach($records as $key=>$r)
          <tr>
            <td><a class="btn btn-info btn-block" href="{{ url('/medical_record/'.$r->id.'/edit')}}">see more</a></td>
            <td>{{ $r->treatment_number}}</td>
            <td>{{ $r->main_complaint}}</td>
            <td>{{ date('d-m-Y', strtotime($r->date))}}</td>
            <td>
              <form class="form-horizontal" action="{{ url('/medical_record/'.$r->id)}}" method="post" role="form">
              {!! csrf_field() !!}
                <input type="hidden" name="_method" value="delete" />
                <input type="submit" class="btn btn-danger btn-block" value="Delete">
              </form>
            </td>
          </tr>
          @endforeach
          @else
          <div class="col-sm-12" align="center">
            <h3>No Data Yet !</h3>
          </div>
          @endif
        </table>
      </div>
    </div>
</div>
@endsection
