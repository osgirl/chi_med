@extends('layouts.app')

@section('content')
<script type="text/javascript">
function change(input){
  var label = input.parentNode;
  var name = input.getAttribute("name");
  var acc_number = document.getElementById('acc_number');
  if(input.checked){
    label.style.backgroundColor = '#DCEDC8';
    label.innerHTML = '<input type="checkbox" name="' + name + '" autocomplete="off" onchange="change(this);" value="1" checked> Yes';
    acc_number.disabled = false;
  }else{
    label.style.backgroundColor = '#F8BBD0';
    label.innerHTML = '<input type="hidden" name="' + name + '" value="0">';
    label.innerHTML += '<input type="checkbox" autocomplete="off" name="' + name + '" onchange="change(this);"> No';
    acc_number.value = "";
    acc_number.disabled = true;
  }
}
</script>
<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="col-sm-3">
          <a href="{{ url('patient/'.$patient->id ) }}" class="btn btn-warning btn-block">
            Back
          </a>
        </div>
          @if(count($patient)>0)
          <form action="{{ url('/patient/'.$patient->id)}}" method="post" role="form">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="put" />
            <div class="form-group">
              <table class="table table-hover table-bordered table-condense">
                <tr class="info">
                  <th colspan="6">Patient Informations</th>
                </tr>
                <tr>
                  <td class="warning">Surame</td>
                  <td><input class="form-control" type="text" name="surname" value="{{ $patient->surname}}" required></td>
                  <td class="warning">Last Name</td>
                  <td><input class="form-control" type="text" name="last_name" value="{{ $patient->last_name}}" required></td>
                  <td class="warning">Patient Code</td>
                  <td><input class="form-control" type="text" name="patient_code" value="{{ $patient->patient_code}}" required></td>
                </tr>
                <tr>
                  <td class="warning">Phone</td>
                  <td><input class="form-control" type="text" name="phone" value=" {{ $patient->phone}}"></td>
                  <td class="col-sm-2 warning">D.O.B</td>
                  <td class="col-sm-2">
                    <input class="form-control" type="text" name="DOB" value="{{ date('d-m-Y', strtotime($patient->DOB)) }}" placeholder="dd-mm-yyyy">
                  </td>
                  <td class="col-sm-2 warning">Cell Phone</td>
                  <td class="col-sm-2"><input class="form-control" type="text" name="cell_phone" value="{{ $patient->cell_phone}}"></td>
                </tr>
                <tr>
                  <td class="col-sm-2 warning">Gender</td>
                  <td class="col-sm-2">
                    <select name="gender" class="form-control">
                      <option value="Male" @if($patient->gender == "Male") selected @endif>Male</option>
                      <option value="Female" @if($patient->gender == "Female") selected @endif>Female</option>
                      <option value="Other" @if($patient->gender == "Other") selected @endif>Other</option>
                    </select>
                  </td>
                  <td class="warning">ACC Number</td>
                  <td><input class="form-control" id="acc_number" type="text" name="acc_number" value="{{ $patient->acc_number}}"></td>
                  <td class="warning">Blood Type</td>
                  <td><input class="form-control" type="text" name="blood_type" value="{{ $patient->blood_type}}"></td>
                </tr>
                <tr>
                  <td class="warning">ACC</td>
                  <td>
                    <div class="col-sm-12">
                      @if($patient->acc == 1)
                      <label class="btn btn-block" style="background-color:#DCEDC8;">
                        <input type="checkbox" autocomplete="off" name="acc" value="1" onchange="change(this);" checked> YES
                      </label>
                      @else
                      <label class="btn btn-block" style="background-color:#F8BBD0;">
                        <input type="checkbox" autocomplete="off" name="acc" value="1" onchange="change(this);"> No
                      </label>
                      @endif
                    </div>
                  </td>
                  <td class="warning">Address</td>
                  <td colspan="3">
                    <input class="form-control" type="text" name="address" value="{{ $patient->address}}">
                  </td>
                </tr>
              </table>
              <input type="submit" class="btn btn-success" value="Save">
            </div>
          </form>
          @endif
      </div>
    </div>
</div>
@endsection
