@extends('layouts.app')

@section('content')
<!--physical examination page-->
<script type="text/javascript">
  function change(input ,row_id){
    var label = input.parentNode;
    var row = input.parentNode.parentNode.parentNode.cells;
    if(input.checked){
      label.style.backgroundColor = '#DCEDC8';
      label.innerHTML = '<input type="checkbox" autocomplete="off" onchange="change(this ,'+row_id+');" checked> Yes';
      row[3].innerHTML ="<input type='text' class='form-control' name='value[]' value=''>";
      row[3].innerHTML +="<input type='hidden' name='minor_id[]' value='"+row_id+"'>";
    }else{
      label.style.backgroundColor = '#F8BBD0';
      label.innerHTML = '<input type="checkbox" autocomplete="off" onchange="change(this,'+row_id+');"> No';
      row[3].innerHTML ="<input type='text' class='form-control' disabled>";
    }
  }

  function PE_databind(){
    var text = "";
    for (var i = 0; i< {{count($pe_minors)}}; i++) {
      var row = document.getElementById('row_'+i).cells;
      var inputs = row[3].childNodes[0];
      var description = row[2].childNodes[0].innerHTML;
      if (typeof inputs.value != "undefined" && inputs.value != null && !inputs.disabled){
        text += description + " : " + inputs.value + "\r\n";
      }
    }
    document.getElementById('physical_examinations').innerHTML = text;
  }
</script>
<div class="">
    <div class="row">
      <h1 class="page-header">First Visit</h1>
      <div class="well well-sm col-sm-12">
        <div class="col-sm-3">
          <a href="{{ url('/patient/'.$patient->id)}}" class="btn btn-warning btn-block">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Back
          </a>
        </div>
      </div>
        <div class="col-md-10 col-md-offset-1">
          <form class="form" action="{{ url('/medical_record')}}" method="post" role="form">
            {!! csrf_field() !!}
            <div class="form-group">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Main</a></li>
                <li role="presentation"><a href="#physical" aria-controls="physical" role="tab" data-toggle="tab">Physical</a></li>
              </ul>
              <div class="tab-content">
                <!--main page-->
                <div role="tabpanel" class="tab-pane fade in active" id="main">
                  <table class="table table-hover table-bordered table-condense">
                    <tr class="warning">
                      <th>
                        {{ $patient->surname}} {{$patient->last_name}}
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <input type="hidden" name="acc_id" value="{{ $acc_id }}">
                      </th>
                      <th>
                        DOB : {{ date('d-m-Y', strtotime($patient->DOB))}}
                      </th>
                      <th>
                        No.
                      </th>
                      <td>
                        <input class="form-control" type="number" min="0" step="1" name="treatment_number" value="{{ $treatment_number }}" required>
                      </td>
                      <td>Date</td>
                      <td>
                        <div class="input-append date" id="dp3" data-date="{{ date('d-m-Y')}}" data-date-format="dd-mm-yyyy">
                          <input class="span2 form-control" name="date" size="16" type="text" value="{{ date('d-m-Y')}}" required>
                          <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th class="warning">Injury Date</th>
                      <td colspan="5">
                        <div class="input-append date" id="dp3" data-date="{{ date('d-m-Y')}}" data-date-format="dd-mm-yyyy">
                          <input class="span2 form-control" name="injury_date" size="16" type="text" placeholder="dd-mm-yyyy" required>
                          <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th class="info" colspan="6">Symptoms</th>
                    </tr>
                    <tr>
                      <td class="warning">Main Complaint / S</td>
                      <td colspan="5"><input class="form-control" type="text" name="main_complaint" value=""></td>
                    </tr>
                    <tr>
                      <td class="warning">Current Condition and Accompanied Symptoms</td>
                      <td colspan="5"><textarea class="form-control" rows="7" name="symptoms"></textarea></td>
                    </tr>
                    <tr>
                      <td class="warning">General Question</td>
                      <td colspan="5"><textarea class="form-control" rows="7" name="general_question"></textarea></td>
                    </tr>
                    <tr>
                      <td class="warning">Past History</td>
                      <td colspan="5">
                        <div class="col-sm-12">
                          <div class="col-sm-6">
                            <label>
                              <input type="checkbox" name="infectious_disease" value="1"> -Infectious disease (TB, HIV, Hepatitis)
                            </label>
                          </div>
                          <div class="col-sm-3">
                            <label>
                              <input type="checkbox" name="asthma" value="1"> -Asthma
                            </label>
                          </div>
                          <div class="col-sm-3">
                            <label>
                              <input type="checkbox" name="cancer" value="1"> -Cancer
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="col-sm-6">
                            <label>
                              <input type="checkbox" name="abnormal_blood_pressure" value="1"> -Abnormal blood pressure
                            </label>
                          </div>
                          <div class="col-sm-3">
                            <label>
                              <input type="checkbox" name="heart_condition" value="1"> -Heart condition
                            </label>
                          </div>
                          <div class="col-sm-3">
                            <label>
                              <input type="checkbox" name="diabetes" value="1"> -Diabetes
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="col-sm-6">
                            <label>
                              <input type="checkbox" name="mental_health_conditions" value="1"> -Mental health conditions
                            </label>
                          </div>
                          <div class="col-sm-3">
                            <label>
                              <input type="checkbox" name="bleeding_disorders" value="1"> -Bleeding disorders
                            </label>
                          </div>
                          <div class="col-sm-3">
                            <label>
                              <input type="checkbox" name="epilepsy" value="1"> -Epilepsy
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="col-sm-6">
                            <label>
                              <input type="checkbox" name="thyroid_diseases" value="1"> -Thyroid diseases
                            </label>
                          </div>
                          <div class="col-sm-3">
                            <label>
                              <input type="checkbox" name="surgery" value="1"> -Surgery
                            </label>
                          </div>
                          <div class="col-sm-3">
                            <label>
                              <input type="checkbox" name="fractures" value="1"> -Fractures
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="col-sm-12">
                            <label>
                              <input type="checkbox" name="taking_prescribed_medicine" value="1"> -Are you taking any prescribed medicine? (Antibiotics, Anticoagulants, Antidepressants)
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="col-sm-12">
                            <label>
                              <input type="checkbox" name="regularly_take_supplement" value="1"> -Do you regularly take aspirin, Painkillers, Herbs, Vitamins or supplements?
                            </label>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="warning">If yes to any of the above, please give the full details</td>
                      <td colspan="5">
                        <textarea class="form-control" rows="7" name="full_details"></textarea>
                      </td>
                    </tr>
                    <tr>
                      <td class="warning">Mentruation, marital & obstetrical history</td>
                      <td colspan="5">
                        <textarea class="form-control" rows="7" name="menstruation"></textarea>
                      </td>
                    </tr>
                    <tr>
                      <td class="warning">Current Physical Examinations
                        <button type="button" class="btn btn-default btn-block" onclick="PE_databind();">Add</button>
                      </td>
                      <td colspan="5"><textarea class="form-control" rows="7" id="physical_examinations" name="physical_examinations"></textarea></td>
                    </tr>
                    <tr>
                      <td class="warning">Family History</td>
                      <td colspan="5">
                        <textarea class="form-control" rows="7" name="family_history"></textarea>
                      </td>
                    </tr>
                    <tr class="info">
                      <th colspan="6">Tongue:</th>
                    </tr>
                    <tr>
                      <td class="col-sm-1 warning">Tongue Texture</td>
                      <td colspan="2" class="col-sm-3">
                        <label class="radio-inline">
                          <input type="radio" name="tongue_status" value="Moistening">Moistening
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="tongue_status" value="Dryness">Dryness
                        </label>
                      </td>
                      <td class="col-sm-1 warning">Body Colour</td>
                      <td colspan="2" class="col-sm-3"><input class="form-control" type="text" name="body_colour" value=""></td>
                    </tr>
                    <tr>
                      <td class="warning">Shape</td>
                      <td colspan="2"><input class="form-control" type="text" name="shape" value=""></td>
                      <td class="warning">Movement</td>
                      <td colspan="2"><input class="form-control" type="text" name="movement" value=""></td>
                    </tr>
                    <tr>
                      <td class="warning">Proper of Coating</td>
                      <td colspan="2"><input class="form-control" type="text" name="proper_of_coating" value=""></td>
                      <td class="warning">Coating Colour</td>
                      <td colspan="2"><input class="form-control" type="text" name="coating_colour" value=""></td>
                    </tr>
                    <tr>
                      <td class="warning">Pulses (Overall Speed)</td>
                      <td colspan="5">
                        <label class="radio-inline">
                          <input type="radio" name="pulses" value="Slow">Slow
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="pulses" value="Moderate">Moderate
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="pulses" value="Fast">Fast
                        </label>
                      </td>
                    </tr>
                    <tr class="info">
                      <td colspan="3" align="center">Right</td>
                      <td colspan="3" align="center">Left</td>
                    </tr>
                    <tr>
                      <td class="warning">Lung (qi)</td>
                      <td colspan="2"><input class="form-control" type="text" name="lung_qi" value=""></td>
                      <td class="warning">Heart (blood)</td>
                      <td colspan="2"><input class="form-control" type="text" name="heart_blood" value=""></td>
                    </tr>
                    <tr>
                      <td class="warning">Spleen</td>
                      <td colspan="2"><input class="form-control" type="text" name="spleen" value=""></td>
                      <td class="warning">Liver</td>
                      <td colspan="2"><input class="form-control" type="text" name="liver" value=""></td>
                    </tr>
                    <tr>
                      <td class="warning">Kidney (yang / qi)</td>
                      <td colspan="2"><input class="form-control" type="text" name="kidney_yang" value=""></td>
                      <td class="warning">Kidney (yin)</td>
                      <td colspan="2"><input class="form-control" type="text" name="kidney_yin" value=""></td>
                    </tr>
                    <tr>
                      <td class="warning">TCM Disease</td>
                      <td colspan="5"><input class="form-control" type="text" name="TCM_disease" value=""></td>
                    </tr>
                    <tr>
                      <td class="warning">TCM Type / Pattern</td>
                      <td colspan="5"><input class="form-control" type="text" name="TCM_type" value=""></td>
                    </tr>
                    <tr>
                      <td class="warning">Treatment Principle</td>
                      <td colspan="5"><input class="form-control" type="text" name="treatment_principle" value=""></td>
                    </tr>
                    <tr>
                      <td class="warning">Acu-points & Techniques/s & Methods/s</td>
                      <td colspan="5"><textarea class="form-control" rows="7" name="Acu_points"></textarea></td>
                    </tr>
                    <tr>
                      <td class="warning">Explanation Of Treatment</td>
                      <td colspan="5"><textarea class="form-control" rows="7" name="treatment_explanation"></textarea></td>
                    </tr>
                    <tr>
                      <td class="warning">Cautions, Contraindications and Red Flag</td>
                      <td colspan="5"><input class="form-control" type="text" name="cautions" value=""></td>
                    </tr>
                    <tr>
                      <td class="warning">Post Treatment Advice</td>
                      <td colspan="5"><textarea class="form-control" rows="7" name="treatment_adjustments"></textarea></td>
                    </tr>
                  </table>
                  <input type="submit" class="btn btn-success" value="Submit">
                  <button type="button" class="btn btn-danger" name="button" onclick="window.history.back();">Cancel</button>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="physical">
                  <div class="col-sm-12">
                    <div class="col-sm-12">
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @if(count($pe_majors)>0)
                          @foreach($pe_majors as $key => $p)
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading_{{$p->id}}">
                              <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$p->id}}" aria-expanded="false" aria-controls="collapse_{{$p->id}}">
                                  {{ $p->part }}
                                </a>
                              </h4>
                            </div>
                            <div id="collapse_{{$p->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_{{$p->id}}">
                              <div class="panel-body">
                                @if(count($pe_minors)>0)
                                <table class="table table-hover table-bordered table-condense">
                                  @foreach($pe_minors as $key_m => $minor)
                                    @if($minor->major_id == $p->id)
                                    <tr id="row_{{$key_m}}">
                                      <td class="col-sm-3">
                                        <img src="../../../{{$minor->img_url}}" alt="{{$minor->description}}" class="img-thumbnail">
                                      </td>
                                      <td class="col-sm-3">
                                        <label class="btn btn-block" style="background-color:#F8BBD0;">
                                          <input type="checkbox" autocomplete="off" onchange="change(this, {{$minor->id}});"> No
                                        </label>
                                      </td>
                                      <td class="col-sm-3"><h4>{{ $p->part }} {{ $minor->description }}</h4></td>
                                      <td>
                                        <input type="text" class="form-control" disabled>
                                      </td>
                                    </tr>
                                    @endif
                                  @endforeach
                                </table>
                                @endif
                              </div>
                            </div>
                          </div>
                          @endforeach
                        @else
                        <h3>Not set yet !</h3>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection
