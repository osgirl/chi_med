@extends('layouts.print_layout')

@section('content')
<div class="">
    <div class="row">
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
                    Current Physical Examinations
                </td>
                <td colspan="5">
                    {{ $record->physical_examinations}}
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
