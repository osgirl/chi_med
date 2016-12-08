@extends('layouts.app')

@section('content')
<script type="text/javascript">
function change(input){
  var label = input.parentNode;
  var name = input.getAttribute("name");
  if(input.checked){
    label.style.backgroundColor = '#DCEDC8';
    label.innerHTML = '<input type="checkbox" name="' + name + '" autocomplete="off" onchange="change(this);" value="1" checked> Yes';
  }else{
    label.style.backgroundColor = '#F8BBD0';
    label.innerHTML = '<input type="hidden" name="' + name + '" value="0">';
    label.innerHTML += '<input type="checkbox" autocomplete="off" name="' + name + '" onchange="change(this);"> No';
  }
}
</script>
<div class="">
    <div class="row">
      <h1 class="page-header">Permission Setup</h1>
      <div class="well well-sm col-sm-12">
        <div class="col-sm-3">
          <a href="{{ url('home')}}" class="btn btn-warning btn-block">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Back
          </a>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="col-sm-10">
          <form action="{{ url('/user') }}" method="post">
            {!! csrf_field() !!}
            <table class="table table-hover table-condensed table-striped">
              <tr>
                <td>
                  Registered User
                </td>
                <td>
                  Email
                </td>
                <td>
                  Administrator
                </td>
                <td>
                  Employee
                </td>
              </tr>
              @foreach($user as $key => $u)
              <tr>
                <td>
                  {{$u->name}}
                  <input type="hidden" name="id[]" value="{{ $u->id }}">
                </td>
                <td>
                  {{$u->email}}
                </td>
                <td>
                  @if($u->admin)
                    <label class="btn btn-block" style="background-color:#DCEDC8;">
                      @if($key == 0)
                      <input type="hidden" name="admin[]" value="1" checked>
                      <input type="checkbox" name="admin[]" checked disabled>
                      Yes
                      @else
                      <input type="checkbox" autocomplete="off" name="admin[]" onchange="change(this);" value="1" checked>
                      Yes
                      @endif
                    </label>
                  @else
                    <label class="btn btn-block" style="background-color:#F8BBD0;">
                      <input type="hidden" name="admin[]" value="0">
                      <input type="checkbox" name="admin[]" autocomplete="off" onchange="change(this);"> No
                    </label>
                  @endif
                </td>
                <td>
                  @if($u->user)
                    <label class="btn btn-block" style="background-color:#DCEDC8;">
                      <input type="checkbox" autocomplete="off" name="user[]" onchange="change(this);" value="1" checked>
                      Yes
                    </label>
                  @else
                    <label class="btn btn-block" style="background-color:#F8BBD0;">
                      <input type="hidden" name="user[]" value="0">
                      <input type="checkbox" name="user[]" autocomplete="off" onchange="change(this);"> No
                    </label>
                  @endif
                </td>
              </tr>
              @endforeach
            </table>
            <div class="col-sm-3 col-sm-offset-9">
              <input value="Save" onclick="saveBtn(this);" class="btn btn-success btn-block">
            </div>
          </form>
        </div>
        <div class="col-sm-2">
          <table class="table table-hover table-condensed table-striped">
            <tr class="warning">
              <td>
                Be Careful !
              </td>
            </tr>
            @foreach($user as $key => $u)
            <tr>
              <td>
                <form class="form-horizontal" action="{{ url('/user/'.$u->id)}}" method="post" role="form">
                  {!! csrf_field() !!}
                  <input type="hidden" name="_method" value="delete" />
                  <input class="btn btn-danger btn-block" value="Delete" onclick="deleteBtn(this);" @if($key==0) disabled @endif>
                </form>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
</div>
@endsection
