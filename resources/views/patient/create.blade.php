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
        <form action="{{ url('/patient')}}" method="post" role="form">
          {!! csrf_field() !!}
          <div class="form-group">
            <table class="table table-hover table-bordered table-condense">
              <tr class="info">
                <th colspan="6">Patient Informations</th>
              </tr>
              <tr>
                <td class="warning">Name</td>
                <td><input class="form-control" type="text" name="name" value="" required></td>
                <td class="warning">Patient Code</td>
                <td><input class="form-control" type="text" name="patient_code" value="" required></td>
                <td class="warning">Phone</td>
                <td><input class="form-control" type="text" name="phone" value=""></td>
              </tr>
              <tr>
                <td class="col-sm-2 warning">Gender</td>
                <td class="col-sm-2">
                  <select name="gender" class="form-control">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                </td>
                <td class="col-sm-2 warning">D.O.B</td>
                <td class="col-sm-2">
                  <input class="form-control" type="text" name="DOB" value="" placeholder="dd-mm-yyyy">
                </td>
                <td class="col-sm-2 warning">Cell Phone</td>
                <td class="col-sm-2"><input class="form-control" type="text" name="cell_phone" value=""></td>
              </tr>
              <tr>
                <td class="warning">ACC</td>
                <td>
                  <div class="col-sm-12">
                    <label class="btn btn-block" style="background-color:#DCEDC8;">
                      <input type="checkbox" autocomplete="off" name="acc" value="1" onchange="change(this);" checked> YES
                    </label>
                  </div>
                </td>
                <td class="warning">ACC Number</td>
                <td><input class="form-control" id="acc_number" type="text" name="acc_number" value=""></td>
                <td class="warning">Blood Type</td>
                <td><input class="form-control" type="text" name="blood_type" value=""></td>
              </tr>
              <tr>
                <td class="warning">Address</td>
                <td colspan="5">
                  <input class="form-control" type="text" name="address" value="">
                </td>
              </tr>
            </table>
            <input type="submit" class="btn btn-success" value="Save">
          </div>
        </form>
    </div>
</div>
@endsection
