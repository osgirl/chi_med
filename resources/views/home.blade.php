@extends('layouts.app')

@section('content')
<div class="">
  <div class="row">
      <div class="col-sm-12">
        <h1 class="page-header animated fadeIn">{{ env('APP_NAME', 'Recomed')}}</h1>
      </div>
  </div>
    <div class="row">
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
