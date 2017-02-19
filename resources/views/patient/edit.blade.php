@extends('layouts.app')

@section('content')
<script type="text/javascript">
/*
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
*/
function addRow() {
  var table = document.getElementById("tblACC");
  var num = document.getElementById("tblACC").rows.length;
  var row = table.insertRow(num);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);

  cell1.innerHTML = '<input type="text" class="form-control" name="acc_number[]" required>';
  cell2.innerHTML = '<input type="text" class="form-control" name="acc_part[]">';
  cell3.innerHTML = '<input type="button" class="btn btn-raised btn-danger btn-sm" onclick="delRow(this)" value="Delete">';

}
function delRow(btn) {
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
}
</script>
<div class="">
    <div class="row">
      <h1 class="page-header">Edit Patient</h1>
      <div class="col-sm-12">
        <div class="col-sm-12 well well-sm">
          <div class="col-sm-3">
            <a href="{{ url('patient/'.$patient->id ) }}" class="btn btn-warning btn-block">
              <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
              Back
            </a>
            <p></p>
          </div>
        </div>
          @if(count($patient)>0)
          <form action="{{ url('/patient/'.$patient->id)}}" method="post" role="form">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="put" />
            <div class="form-group col-sm-12">
              <table class="table table-hover table-bordered table-condense">
                <tr class="info">
                  <th colspan="8">Patient Informations</th>
                </tr>
                <tr>
                  <td class="warning">Surame</td>
                  <td><input class="form-control" type="text" name="surname" value="{{ $patient->surname}}" required></td>
                  <td class="warning">Last Name</td>
                  <td><input class="form-control" type="text" name="last_name" value="{{ $patient->last_name}}" required></td>
                  <td class="warning">Patient Code</td>
                  <td><input class="form-control" type="text" name="patient_code" value="{{ $patient->patient_code}}" required></td>
                  <td class="col-sm-2 warning">Gender</td>
                  <td class="col-sm-2">
                    <select name="gender" class="form-control">
                      <option value="Male" @if($patient->gender == "Male") selected @endif>Male</option>
                      <option value="Female" @if($patient->gender == "Female") selected @endif>Female</option>
                      <option value="Other" @if($patient->gender == "Other") selected @endif>Other</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="warning">Phone</td>
                  <td><input class="form-control" type="text" name="phone" value=" {{ $patient->phone}}"></td>
                  <td class="warning">D.O.B</td>
                  <td>
                    <input class="form-control datepicker" type="text" name="DOB" value="{{ date('d-m-Y', strtotime($patient->DOB)) }}" placeholder="dd-mm-yyyy">
                  </td>
                  <td class="warning">Cell Phone</td>
                  <td><input class="form-control" type="text" name="cell_phone" value="{{ $patient->cell_phone}}"></td>
                  <td class="warning">Blood Type</td>
                  <td><input class="form-control" type="text" name="blood_type" value="{{ $patient->blood_type}}"></td>
                </tr>
                <tr>
                  <td class="warning">Address</td>
                  <td colspan="7">
                    <input class="form-control" type="text" name="address" value="{{ $patient->address}}">
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-sm-12">
              <input type="submit" class="btn btn-success btn-block" value="Save">
            </div>
          </form>
          @endif
      </div>
    </div>
</div>
@endsection
