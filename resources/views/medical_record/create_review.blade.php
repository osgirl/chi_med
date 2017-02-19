@extends('layouts.app')

@section('content')
<div class="">
    <div class="row">
      <h1 class="page-header">Add Review</h1>
      <div class="well well-sm col-sm-12">
        <div class="col-sm-3">
          <a href="{{ url('/patient/'.$patient->id)}}" class="btn btn-warning btn-block">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Back
          </a>
        </div>
      </div>
        <div class="col-sm-10 col-sm-offset-1">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Review Form</a></li>
            <li role="presentation"><a href="#previous" aria-controls="previous" role="tab" data-toggle="tab">Previous Records</a></li>
          </ul>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="review">
              <form class="form" action="{{ url('/medical_review')}}" method="post" role="form">
                {!! csrf_field() !!}
                <div class="form-group">
                  <table class="table table-hover table-bordered table-condense">
                    <tr class="info">
                      <th>Name :</th>
                      <td>{{ $patient->surname }} {{ $patient->last_name }}</td>
                      <th>DOB :</th>
                      <td>{{ $patient->DOB }}</td>
                      <th>Gender :</th>
                      <td>{{ $patient->gender }}</td>
                      <input type="hidden" name="treatment_number" value="{{ $patient->treatment_number }}">
                      <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                      <input type="hidden" name="acc_id" value="{{ $patient->acc_id }}">
                    </tr>
                    <tr>
                      <th class="warning col-sm-1">Summary</th>
                      <td class="col-sm-9" colspan="5"><textarea class="form-control" rows="5" name="summary"></textarea></td>
                    </tr>
                    <tr>
                      <th class="warning">Investigation</th>
                      <td colspan="5"><textarea class="form-control" rows="5" name="investigation"></textarea></td>
                    </tr>
                    <tr>
                      <th class="warning">Outcomes</th>
                      <td colspan="5"><textarea class="form-control" rows="5" name="outcomes"></textarea></td>
                    </tr>
                    <tr>
                      <th class="warning">Differential Diagnosis</th>
                      <td colspan="5"><textarea class="form-control" rows="5" name="differential_diagnosis"></textarea></td>
                    </tr>
                    <tr>
                      <th class="warning">Treatment</th>
                      <td colspan="5"><textarea class="form-control" rows="5" name="treatment"></textarea></td>
                    </tr>
                    <tr>
                      <th class="warning">Discussion</th>
                      <td colspan="5"><textarea class="form-control" rows="5" name="discussion"></textarea></td>
                    </tr>
                  </table>
                  <input type="submit" class="btn btn-success" value="Submit">
                </div>
              </form>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="previous">
              <ul class="nav nav-tabs" role="tablist">
                @foreach($previous_info as $key => $pre)
                  <li role="presentation" @if($key==0) class="active" @endif><a href="#{{ $pre->treatment_number }}" aria-controls="review" role="tab" data-toggle="tab">Treatment {{$pre->treatment_number}}</a></li>
                @endforeach
              </ul>
              <div class="tab-content">
                @foreach($previous_info as $key => $pre)
                  <div role="tabpanel" class="tab-pane fade @if($key==0) in active @endif" id="{{ $pre->treatment_number}}">
                    <table class="table table-condensed table-hover table-bordered">
                      <tr class="warning">
                        <th width="125px">
                          <p>
                            {{ $patient->surname}} {{$patient->last_name}}
                          </p>
                        </th>
                        <th>
                          <p>
                            DOB : {{ date('d-m-Y', strtotime($patient->DOB))}}
                          </p>
                        </th>
                        <th>
                          <p>
                            No.
                          </p>
                        </th>
                        <td width="125px">
                          <p>
                            {{ $pre->treatment_number }}
                          </p>
                        </td>
                        <td>
                          <p>
                            Date
                          </p>
                        </td>
                        <td>
                          <p>
                            {{ date('d-m-Y', strtotime($pre->date))}}
                          </p>
                        </td>
                      </tr>
                      <tr>
                        <th class="info" colspan="6">
                          <p>
                            Symptoms
                          </p>
                        </th>
                      </tr>
                      <tr>
                        <td class="warning">
                          <p>
                            Main Complaint / S
                          </p>
                        </td>
                        <td colspan="5">
                          <p>
                            {{ $pre->main_complaint}}
                          </p>
                        </td>
                      </tr>
                      <tr>
                        <td class="warning">
                          <p>
                            Current Condition and Accompanied Symptoms
                          </p>
                        </td>
                        <td colspan="5">
                          <p>
                            {{ $pre->symptoms}}
                          </p>
                        </td>
                      </tr>
                      <tr>
                        <td class="warning">
                          <p>
                            General Question
                          </p>
                        </td>
                        <td colspan="5">
                          <p>
                            {{ $pre->general_question }}
                          </p>
                        </td>
                      </tr>
                      <tr>
                        <td class="warning">
                          <p>
                            Current Physical Examinations
                          </p>
                        </td>
                        <td colspan="5">
                          <p>
                            {{ $pre->physical_examinations}}
                          </p>
                        </td>
                      </tr>
                      <tr class="info">
                        <th colspan="6">
                          <p>
                            Tongue:
                          </p>
                        </th>
                      </tr>
                      <tr>
                        <td class="col-sm-1 warning">
                          <p>
                            Tongue Texture
                          </p>
                        </td>
                        <td colspan="2" class="col-sm-3">
                          <p>
                            {{ $pre->tongue_status }}
                          </p>
                        </td>
                        <td class="col-sm-1 warning">
                          <p>
                            Body Colour
                          </p>
                        </td>
                        <td colspan="2" class="col-sm-3">
                          <p>
                            {{ $pre->body_colour}}
                          </p>
                        </td>
                      </tr>
                      <tr>
                        <td class="warning"><p>Shape</p></td>
                        <td colspan="2"><p>{{ $pre->shape}}</p></td>
                        <td class="warning"><p>Movement</p></td>
                        <td colspan="2"><p>{{$pre->movement}}</p></td>
                      </tr>
                      <tr>
                        <td class="warning"><p>Proper of Coating</p></td>
                        <td colspan="2"><p>{{ $pre->proper_of_coating}}</p></td>
                        <td class="warning"><p>Coating Colour</p></td>
                        <td colspan="2"><p>{{ $pre->coating_colour}}</p></td>
                      </tr>
                      <tr>
                        <td class="warning"><p>Pulses (Overall Speed)</p></td>
                        <td colspan="5">
                          <p>
                            {{ $pre->pulses }}
                          </p>
                        </td>
                      </tr>
                      <tr class="warning">
                        <td colspan="3" align="center"><p>Right</p></td>
                        <td colspan="3" align="center"><p>Left</p></td>
                      </tr>
                      <tr>
                        <td class="warning"><p>Lung (qi)</p></td>
                        <td colspan="2"><p>{{ $pre->lung_qi}}</p></td>
                        <td class="warning"><p>Heart (blood)</p></td>
                        <td colspan="2"><p>{{ $pre->heart_blood}}</p></td>
                      </tr>
                      <tr>
                        <td class="warning"><p>Spleen</p></td>
                        <td colspan="2"><p>{{ $pre->spleen}}</p></td>
                        <td class="warning"><p>Liver</p></td>
                        <td colspan="2"><p>{{ $pre->liver}}</p></td>
                      </tr>
                      <tr>
                        <td class="warning"><p>Kidney (yang / qi)</p></td>
                        <td colspan="2"><p>{{ $pre->kidney_yang}}</p></td>
                        <td class="warning"><p>Kidney (yin)</p></td>
                        <td colspan="2"><p>{{ $pre->kidney_yin}}</p></td>
                      </tr>
                      <tr>
                        <td class="warning"><p>TCM Disease</p></td>
                        <td colspan="5"><p>{{ $pre->TCM_disease}}</p></td>
                      </tr>
                      <tr>
                        <td class="warning"><p>TCM Type / Pattern</p></td>
                        <td colspan="5"><p>{{ $pre->TCM_type}}</p></td>
                      </tr>
                      <tr>
                        <td class="warning"><p>Treatment Principle</p></td>
                        <td colspan="5"><p>{{ $pre->treatment_principle}}</p></td>
                      </tr>
                      <tr>
                        <td class="warning"><p>Acu-points & Techniques/s & Methods/s</p></td>
                        <td colspan="5"><p>{{ $pre->Acu_points}}</p></td>
                      </tr>
                      <tr>
                        <td class="warning"><p>Explanation Of Treatment</p></td>
                        <td colspan="5"><p>{{ $pre->treatment_explanation}}</p></td>
                      </tr>
                      <tr>
                        <td class="warning"><p>Cautions, Contraindications and Red Flag</p></td>
                        <td colspan="5"><p>{{ $pre->cautions }}</p></td>
                      </tr>
                      <tr>
                        <td class="warning"><p>Post Treatment Advice</p></td>
                        <td colspan="5"><p>{{ $pre->treatment_adjustments}}</p></td>
                      </tr>
                      <tr style="height:75px;">
                        <td class="warning">
                          Signature
                        </td>
                        <td colspan="2">

                        </td>
                        <td class="warning">
                          Date
                        </td>
                        <td colspan="2">

                        </td>
                      </tr>
                    </table>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
