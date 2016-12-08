@extends('layouts.app')

@section('content')
<script type="text/javascript">
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
function checkCode(){
  var codes = [
    @foreach($patient as $p)
    "{{ $p->patient_code }}",
    @endforeach
  ];
  var input = document.getElementById("patient_code").value;
  if(codes.includes(input)){
    swal({
      title:"Warning",
      text: "Code has been used !",
      type: "warning",
    },function(){
      document.getElementById("patient_code").focus();
    });
  }
}
function checkForm(button){
  var codes = [
    @foreach($patient as $p)
    "{{ $p->patient_code }}",
    @endforeach
  ];
  var input = document.getElementById("patient_code").value;
  if(codes.includes(input)){
    swal({
      title:"Warning",
      text: "Code has been used !",
      type: "warning",
    },function(){
      document.getElementById("patient_code").focus();
    });
  }else{
    button.form.submit();
  }
}
</script>
<div class="">
    <div class="row">
      <h1 class="page-header">New Patient</h1>
      <div class="well well-sm col-sm-12">
        <div class="col-sm-3">
          <a href="{{ url('home') }}" class="btn btn-warning btn-block">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Back
          </a>
          <p></p>
        </div>
      </div>
        <form action="{{ url('/patient')}}" method="post" role="form">
          {!! csrf_field() !!}
          <div class="form-group col-sm-8">
            <table class="table table-hover table-bordered table-condense">
              <tr class="info">
                <th colspan="8">Patient Informations</th>
              </tr>
              <tr>
                <td class="warning col-sm-1">Surname</td>
                <td class="col-sm-2"><input class="form-control" type="text" name="surname" value="" required></td>
                <td class="warning col-sm-1">Last Name</td>
                <td class="col-sm-2"><input class="form-control" type="text" name="last_name" value="" required></td>
                <td class="warning col-sm-1">Patient Code</td>
                <td class="col-sm-2"><input class="form-control" type="text" onchange="checkCode();" id="patient_code" name="patient_code" value="" required></td>
                <td class="col-sm-1 warning">Gender</td>
                <td class="col-sm-2">
                  <select name="gender" class="form-control">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="warning">Phone</td>
                <td><input class="form-control" type="text" name="phone" value=""></td>
                <td class="warning">D.O.B</td>
                <td>
                  <input class="form-control" type="text" name="DOB" value="" placeholder="dd-mm-yyyy">
                </td>
                <td class="warning">Cell Phone</td>
                <td><input class="form-control" type="text" name="cell_phone" value=""></td>
                <td class="warning">Blood Type</td>
                <td><input class="form-control" type="text" name="blood_type" value=""></td>
              </tr>
              <tr>
                <td class="warning">Address</td>
                <td colspan="7">
                  <input class="form-control" type="text" name="address" value="">
                </td>
              </tr>
            </table>
          </div>
          <div class="col-sm-4">
            <table class="table table-hover table-bordered table-condense" id="tblACC">
              <tr class="warning">
                <td class="col-sm-7">
                  ACC Number
                </td>
                <td class="col-sm-5">
                  Parts
                </td>
                <td></td>
              </tr>
            </table>
            <button type="button"v class="btn btn-primary" name="button" onclick="addRow();">Add Acc</button>
          </div>
          <div class="col-sm-12">
            <div class="col-sm-4">
              <input type="button" onclick="checkForm(this);" class="btn btn-success btn-block" value="Save">
            </div>
          </div>
        </form>
    </div>
</div>
@endsection
