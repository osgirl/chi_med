@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="col-sm-12">
            <div class="col-sm-4">
              <a href="{{ url('/patient/create') }}" class="thumbnail">
                <h4>New Patient</h4>
                <img src="{{ url('/img/add.png') }}" alt="...">
              </a>
            </div>
            <div class="col-sm-4">
              <a href="{{ url('/patient_index/acc') }}" class="btn btn-default btn-block">
                <h4>ACC Patient</h4>
              </a>
            </div>
            <div class="col-sm-4">
              <a href="{{ url('/patient_index/nonacc') }}" class="btn btn-default btn-block">
                <h4>Non-ACC Patient</h4>
              </a>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
