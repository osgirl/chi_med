@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="well well-sm col-sm-12">
        <div class="col-sm-3">
          @if( count($acc_infos) > 0 )
          <a href="{{ url('/patient_index/acc' ) }}" class="btn btn-warning btn-block">
          @else
          <a href="{{ url('/patient_index/nonacc' ) }}" class="btn btn-warning btn-block">
          @endif
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Back
          </a>
        </div>
        <div class="col-sm-3">
          <a href="{{ url('patient/'.$patient->id.'/edit' ) }}" class="btn btn-info btn-block">
            Edit Patient Informations
          </a>
        </div>
        <div class="col-sm-3">
          <form class="form-horizontal" action="{{ url('/patient/'.$patient->id)}}" method="post" role="form">
          {!! csrf_field() !!}
            <input type="hidden" name="_method" value="delete" />
            <input type="submit" class="btn btn-danger btn-block" value="Delete Patient">
          </form>
        </div>
      </div>

      <div class="col-sm-12">
        @if(count($patient)>0)
        <div class="col-sm-12">
          <table class="table table-hover">
            <tr class="info">
              <th colspan="4">{{ $patient->surname}}  {{ $patient->last_name}}</th>
            </tr>
            <tr>
              <td class="col-sm-2 warning">Patient Code:</td>
              <td class="col-sm-4">{{ $patient->patient_code}}</td>
              <td class="col-sm-2 warning">Birthday:</td>
              <td class="col-sm-4">{{ date('d-m-Y', strtotime($patient->DOB)) }}</td>
            </tr>
            <tr>
              <td class="warning">Name:</td><td>{{ $patient->surname}}  {{ $patient->last_name}}</td>
              <td class="warning">Gender:</td><td>{{ $patient->gender}}</td>
            </tr>
            <tr>
              <td class="warning">Phone:</td><td>{{ $patient->phone}}</td>
              <td class="warning">Cell Phone:</td><td>{{ $patient->cell_phone}}</td>
            </tr>
          </table>
          @endif
        </div>
        <div class="col-sm-12">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          @foreach($acc_infos as $key=>$acc)
            <div class="panel panel-info">
              <div class="panel-heading" role="tab">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{ $acc->acc_number}}" aria-expanded="@if($key==0) true @else false @endif" aria-controls="{{ $acc->acc_number}}">
                    {{ $acc->acc_number}} ({{ $acc->parts }})
                  </a>
                </h4>
              </div>
              <div id="{{ $acc->acc_number}}" class="panel-collapse collapse @if($key==0) in @endif" role="tabpanel" aria-labelledby="{{ $acc->acc_number}}">
                <div class="panel-body">
                  <div class="col-sm-12">
                    <div class="col-sm-3">
                      <a href="{{ url('/medical_record/create/'.$patient->id.'/'.$acc->id ) }}" class="thumbnail">
                        <img src="{{ url('/img/add.png') }}" alt="...">
                      </a>
                    </div>
                    <div class="col-sm-9">
                      <table class="table table-bordered table-condensed table-hover">
                        @if(count($records)>0)
                        <tr class="info">
                          <th></th>
                          <th></th>
                          <th class="col-sm-1">Treatment Number</th>
                          <th class="col-sm-4">Main Complaint</th>
                          <th class="col-sm-2">Create Date</th>
                          <th></th>
                        </tr>
                        @foreach($records as $key=>$r)
                          @if($r->acc_id == $acc->id)
                          <!--for each 6 inputs-->
                            @if($r->treatment_number % 6 == 0)
                              {{--*/ $count = 0 /*--}}
                              @foreach($reviews as $review)
                                @if($review->acc_id == $acc->id && $review->treatment_number == $r->treatment_number)
                                <tr class="warning">
                                  <td><a class="btn btn-info btn-block" href="{{ url('/medical_review/'.$review->id.'/edit')}}">Details</a></td>
                                  <td><a class="btn btn-default btn-block" href="{{ url('/medical_review/'.$review->id)}}">Print</a></td>
                                  <td colspan="2" align="center"><strong>Review Form</strong></td>
                                  <td>{{ date('d-m-Y', strtotime($review->create_date))}}</td>
                                  <td>
                                    <form class="form-horizontal" action="{{ url('/medical_review/'.$review->id)}}" method="post" role="form">
                                    {!! csrf_field() !!}
                                      <input type="hidden" name="_method" value="delete" />
                                      <input type="button" onclick="deleteBtn(this);" class="btn btn-danger btn-block" value="Delete">
                                    </form>
                                  </td>
                                </tr>
                                {{--*/ $count++ /*--}}
                                @endif
                              @endforeach
                              @if($count == 0)
                              <tr>
                                <td colspan="6">
                                  <a href="{{ url('/medical_review_create/'.$r->id) }}" type="button" class="btn btn-warning btn-block">Create Review Form</a>
                                </td>
                              </tr>
                              @endif
                            @endif
                          <tr>
                            <td><a class="btn btn-info btn-block" href="{{ url('/medical_record/'.$r->id.'/edit')}}">Details</a></td>
                            <td><a class="btn btn-default btn-block" href="{{ url('/medical_record/'.$r->id)}}">Print</a></td>
                            <td>{{ $r->treatment_number}}</td>
                            <td>{{ $r->main_complaint}}</td>
                            <td>{{ date('d-m-Y', strtotime($r->date))}}</td>
                            <td>
                              <form class="form-horizontal" action="{{ url('/medical_record/'.$r->id)}}" method="post" role="form">
                              {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="delete" />
                                <input type="button" onclick="deleteBtn(this);" class="btn btn-danger btn-block" value="Delete">
                              </form>
                            </td>
                          </tr>
                          @endif
                        @endforeach
                        @else
                        <div class="col-sm-12" align="center">
                          <h3>No Data Yet !</h3>
                        </div>
                        @endif
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
          <div class="panel panel-info">
            <div class="panel-heading" role="tab">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#nonacc" aria-expanded="@if(count($acc_infos) == 0) true @else false @endif" aria-controls="nonacc">
                  Non-Acc
                </a>
              </h4>
            </div>
            <div id="nonacc" class="panel-collapse collapse @if(count($acc_infos) == 0) in @endif" role="tabpanel" aria-labelledby="">
              <div class="panel-body">
                <div class="col-sm-12">
                  <div class="col-sm-3">
                    <a href="{{ url('/medical_record/create/'.$patient->id.'/0' ) }}" class="thumbnail">
                      <img src="{{ url('/img/add.png') }}" alt="...">
                    </a>
                  </div>
                  <div class="col-sm-9">
                    <table class="table table-bordered table-condensed table-hover">
                      @if(count($records)>0)
                      <tr class="info">
                        <th></th>
                        <th></th>
                        <th class="col-sm-1">Treatment Number</th>
                        <th class="col-sm-4">Main Complaint</th>
                        <th class="col-sm-2">Create Date</th>
                        <th></th>
                      </tr>
                      @foreach($records as $key=>$r)
                        @if($r->acc_id == 0)
                          @if($r->treatment_number % 6 == 0)
                            {{--*/ $count = 0 /*--}}
                            @foreach($reviews as $review)
                              @if($review->acc_id == 0 && $review->treatment_number == $r->treatment_number)
                              <tr class="warning">
                                <td><a class="btn btn-info btn-block" href="{{ url('/medical_review/'.$review->id.'/edit')}}">Details</a></td>
                                <td><a class="btn btn-default btn-block" href="{{ url('/medical_review/'.$review->id)}}">Print</a></td>
                                <td colspan="2" align="center"><strong>Review Form</strong></td>
                                <td>{{ date('d-m-Y', strtotime($review->create_date))}}</td>
                                <td>
                                  <form class="form-horizontal" action="{{ url('/medical_review/'.$review->id)}}" method="post" role="form">
                                  {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="delete" />
                                    <input type="button" onclick="deleteBtn(this);" class="btn btn-danger btn-block" value="Delete">
                                  </form>
                                </td>
                              </tr>
                              {{--*/ $count++ /*--}}
                              @endif
                            @endforeach
                            @if($count == 0)
                            <tr>
                              <td colspan="6">
                                <a href="{{ url('/medical_review_create/'.$r->id) }}" type="button" class="btn btn-warning btn-block">Create Review Form</a>
                              </td>
                            </tr>
                            @endif
                          @endif
                        <tr>
                          <td><a class="btn btn-info btn-block" href="{{ url('/medical_record/'.$r->id.'/edit')}}">see more</a></td>
                          <td><a class="btn btn-default btn-block" href="{{ url('/medical_record/'.$r->id)}}">Print</a></td>
                          <td>{{ $r->treatment_number}}</td>
                          <td>{{ $r->main_complaint}}</td>
                          <td>{{ date('d-m-Y', strtotime($r->date))}}</td>
                          <td>
                            <form class="form-horizontal" action="{{ url('/medical_record/'.$r->id)}}" method="post" role="form">
                            {!! csrf_field() !!}
                              <input type="hidden" name="_method" value="delete" />
                              <input type="button" onclick="deleteBtn(this);" class="btn btn-danger btn-block" value="Delete">
                            </form>
                          </td>
                        </tr>
                        @endif
                      @endforeach
                      @else
                      <div class="col-sm-12" align="center">
                        <h3>No Data Yet !</h3>
                      </div>
                      @endif
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
