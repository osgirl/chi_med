@extends('layouts.app')

@section('content')
<div class="">
    <div class="row">
      <h1 class="page-header hidden-print">Print</h1>
      <div class="well well- sm col-sm-12 hidden-print">
        <div class="col-sm-3">
          <a href="{{ url('/patient/'.$record->patient_id)}}" class="btn btn-warning btn-block">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Back
          </a>
        </div>
        <div class="col-sm-3">
          <button type="button" onclick="print();" class="btn btn-primary btn-block" name="button">Print</button>
        </div>
      </div>
        <div class="col-sm-12">
          <page size="A4">
            <h4 align="center">{{ env('APP_NAME', 'Recomed') }}</h4>
            <table border="1">
              <tr class="warning">
                <th width="125px">
                  {{ $record->surname}} {{$record->last_name}}
                </th>
                <th>
                  DOB : {{ date('d-m-Y', strtotime($record->DOB))}}
                </th>
                <th>
                  No.
                </th>
                <td width="125px">
                  {{ $record->treatment_number }}
                </td>
                <td>
                  Date
                </td>
                <td>
                  {{ date('d-m-Y', strtotime($record->date))}}
                </td>
              </tr>
              <tr>
                <th class="warning">
                  Injury Date
                </th>
                <td colspan="5">
                  {{ date('d-m-Y', strtotime($record->injury_date))}}
                </td>
              </tr>
              <tr>
                <th class="info" colspan="6">
                  Symptoms
                </th>
              </tr>
              <tr>
                <td class="warning">
                  Main Complaint / S
                </td>
                <td colspan="5">
                  {{ $record->main_complaint}}
                </td>
              </tr>
              <tr>
                <td class="warning">
                  Current Condition and Accompanied Symptoms
                </td>
                <td colspan="5">
                  {{ $record->symptoms}}
                </td>
              </tr>
              <tr>
                <td class="warning">
                  General Question
                </td>
                <td colspan="5">
                  {{ $record->general_question }}
                </td>
              </tr>
              <tr>
                <td class="warning">
                  Past History
                </td>
                <td colspan="5">
                  <div class="col-sm-12">

                      @if($record->infectious_disease) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Infectious disease (TB, HIV, Hepatitis)<br> @endif
                      @if($record->asthma) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Asthma<br> @endif
                      @if($record->cancer) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Cancer<br> @endif
                      @if($record->abnormal_blood_pressure) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Abnormal blood pressure<br> @endif
                      @if($record->heart_condition) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Heart condition<br> @endif
                      @if($record->diabetes) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Diabetes<br> @endif
                      @if($record->mental_health_conditions) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Mental health conditions<br> @endif
                      @if($record->bleeding_disorders) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Bleeding disorders<br> @endif
                      @if($record->epilepsy) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Epilepsy<br> @endif
                      @if($record->thyroid_diseases) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Thyroid diseases<br> @endif
                      @if($record->surgery) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Surgery<br> @endif
                      @if($record->fractures) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Fractures<br> @endif
                      @if($record->taking_prescribed_medicine) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Are you taking any prescribed medicine? (Antibiotics, Anticoagulants, Antidepressants)<br> @endif
                      @if($record->regularly_take_supplement) <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-Do you regularly take aspirin, Painkillers, Herbs, Vitamins or supplements?<br> @endif

                  </div>
                </td>
              </tr>
              <tr>
                <td class="warning">
                    If yes to any of the above, please give the full details
                </td>
                <td colspan="5">
                    {{ $record->full_details}}
                </td>
              </tr>
              <tr>
                <td class="warning">
                    Mentruation, marital & obstetrical history
                </td>
                <td colspan="5">
                    {{ $record->menstruation}}
                </td>
              </tr>
              <tr>
                <td class="warning">
                    Current Physical Examinations
                </td>
                <td colspan="5">
                    {{ $record->physical_examinations}}
                </td>
              </tr>
              <tr>
                <td class="warning">
                    Family History
                </td>
                <td colspan="5">
                  {{ $record->family_history}}
                </td>
              </tr>
              <tr class="info">
                <th colspan="6">
                  Tongue:
                </th>
              </tr>
              <tr>
                <td class="col-sm-1 warning">
                  Tongue Texture
                </td>
                <td colspan="2" class="col-sm-3">
                  {{ $record->tongue_status }}
                </td>
                <td class="col-sm-1 warning">
                  Body Colour
                </td>
                <td colspan="2" class="col-sm-3">
                  {{ $record->body_colour}}
                </td>
              </tr>
              <tr>
                <td class="warning">Shape</td>
                <td colspan="2">{{ $record->shape}}</td>
                <td class="warning">Movement</td>
                <td colspan="2">{{$record->movement}}</td>
              </tr>
              <tr>
                <td class="warning">Proper of Coating</td>
                <td colspan="2">{{ $record->proper_of_coating}}</td>
                <td class="warning">Coating Colour</td>
                <td colspan="2">{{ $record->coating_colour}}</td>
              </tr>
              <tr>
                <td class="warning">Pulses (Overall Speed)</td>
                <td colspan="5">
                  {{ $record->pulses }}
                </td>
              </tr>
              <tr class="warning">
                <td colspan="3" align="center">Right</td>
                <td colspan="3" align="center">Left</td>
              </tr>
              <tr>
                <td class="warning">Lung (qi)</td>
                <td colspan="2">{{ $record->lung_qi}}</td>
                <td class="warning">Heart (blood)</td>
                <td colspan="2">{{ $record->heart_blood}}</td>
              </tr>
              <tr>
                <td class="warning">Spleen</td>
                <td colspan="2">{{ $record->spleen}}</td>
                <td class="warning">Liver</td>
                <td colspan="2">{{ $record->liver}}</td>
              </tr>
              <tr>
                <td class="warning">Kidney (yang / qi)</td>
                <td colspan="2">{{ $record->kidney_yang}}</td>
                <td class="warning">Kidney (yin)</td>
                <td colspan="2">{{ $record->kidney_yin}}</td>
              </tr>
              <tr>
                <td class="warning">TCM Disease</td>
                <td colspan="5">{{ $record->TCM_disease}}</td>
              </tr>
              <tr>
                <td class="warning">TCM Type / Pattern</td>
                <td colspan="5">{{ $record->TCM_type}}</td>
              </tr>
              <tr>
                <td class="warning">Treatment Principle</td>
                <td colspan="5">{{ $record->treatment_principle}}</td>
              </tr>
              <tr>
                <td class="warning">Acu-points & Techniques/s & Methods/s</td>
                <td colspan="5">{{ $record->Acu_points}}</td>
              </tr>
              <tr>
                <td class="warning">Explanation Of Treatment</td>
                <td colspan="5">{{ $record->treatment_explanation}}</td>
              </tr>
              <tr>
                <td class="warning">Cautions, Contraindications and Red Flag</td>
                <td colspan="5">{{ $record->cautions }}</td>
              </tr>
              <tr>
                <td class="warning">Post Treatment Advice</td>
                <td colspan="5">{{ $record->treatment_adjustments}}</td>
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
          </page>
        </div>
    </div>
</div>
@endsection
