@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
          <div class="well well-sm" align="center">
            <div class="container">
              <div class="col-sm-6">
                <h1 class="animated tada">{{ env('APP_NAME', 'Recomed')}}</h1>
                <h2 id="date_now"></h2>
                <h2 id="weekday_now"></h2>
              </div>
              <div class="col-sm-6">
                <div class="clock" style="margin:2em;"></div>
              	<div class="message"></div>
              </div>
            </div>
          </div>
          @if($user->admin == true)
          <div class="col-sm-3">
            <a href="{{{ url('/user') }}}" type="button" class="btn btn-block btn-warning">Permission Setup</a>
            <a href="{{{ url('/physical') }}}" type="button" class="btn btn-block btn-warning">Physical Setup</a>
          </div>
          @endif
          <div class="col-sm-9">
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
