@extends('layouts.app')

@section('content')
<div class="">
    <div class="row">
      <h1 class="page-header">Physical Setup</h1>
      <div class="well well-sm col-sm-12">
        <div class="col-sm-3">
          <a href="{{ url('home')}}" class="btn btn-warning btn-block">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Back
          </a>
        </div>
      </div>
        <div class="col-sm-10 col-sm-offset-1">
          <div class="col-sm-6">
            <form class="form-horizontal" action="{{ url('/physical/major')}}" method="post" role="form">
              {!! csrf_field() !!}
              <div class="form-group">
                <div class="col-sm-12">
                  <label for="">Add Major Parts :</label>
                </div>
                <div class="col-sm-9">
                  <input class="form-control" type="text" name="part" required>
                </div>
                <div class="col-sm-3">
                  <input type="submit" class="btn btn-success btn-block" value="Add">
                </div>
              </div>
            </form>
          </div>
          @if(count($majors)>0)
          <div class="col-sm-12">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach($majors as $key => $major)
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="heading{{$major->part}}">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$major->part}}" aria-expanded="false" aria-controls="collapse_{{$major->part}}">
                    {{ $major->part }}
                  </a>
                </h4>
              </div>
              <div id="collapse_{{$major->part}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$major->part}}">
                <div class="panel-body">
                  <form action="{{ url('physical/minor/'.$major->id) }}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="col-sm-12">
                      <div class="col-sm-4">
                        <label for="">Add Descrption :</label>
                      </div>
                      <div class="col-sm-3">
                        <label for="">Add Img :</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="description" required>
                    </div>
                    <div class="col-sm-3">
                      <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                    <div class="col-sm-2">
                      <input type="submit" class="btn btn-block btn-success" value="Add">
                    </div>
                  </form>
                  <div class="col-sm-3" align="right">
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <form class="form-horizontal" action="{{url('/physical/major/delete/'.$major->id)}}" method="post" role="form">
                          {!! csrf_field() !!}
                            <input type="button" onclick="deleteBtn(this);" class="btn btn-danger btn-block" value="Delete Major Part">
                          </form>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!--show description parts-->
                  <div class="col-sm-12" style="padding-top:20px;">
                    @if(count($minors)>0)
                    <table class="table table-hover table-condensed ">
                      <tr>
                        <td class="col-sm-3">Description</td>
                        <td class="col-sm-3">Image</td>
                        <td class="col-sm-3">Change Image</td>
                        <td class="col-sm-3"></td>
                      </tr>
                      @foreach($minors as $minor)
                        @if($minor->major_id == $major->id)
                        <form action="{{ url('physical/minor/update/'.$minor->id) }}" method="post" enctype="multipart/form-data">
                          {!! csrf_field() !!}
                          <input type="hidden" name="major_id" value="{{ $major->id }}">
                          <tr>
                            <td><input type="text" class="form-control" name="description" value="{{$minor->description}}" required></td>
                            <td><img src="{{$minor->img_url}}" alt="{{$minor->description}}" class="img-thumbnail"></td>
                            <td>
                              <input type="file" name="fileToUpload" id="fileToUpload">
                            </td>
                            <td>
                              <div class="btn-group">
                                <input type="submit" class="btn btn-success" value="Update">
                              </form>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                  <li>
                                    <form class="form-horizontal" action="{{url('/physical/minor/delete/'.$minor->id)}}" method="post" role="form">
                                    {!! csrf_field() !!}
                                      <input type="button" onclick="deleteBtn(this);" class="btn btn-danger btn-block" value="Delete">
                                    </form>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        @endif
                      @endforeach
                    </table>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            </div>
          </div>
          @endif
        </div>
    </div>
</div>
@endsection
