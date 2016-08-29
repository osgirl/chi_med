@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form class="form-horizontal" action="{{ url('/physical')}}" method="post" role="form">
              {!! csrf_field() !!}
              <div class="form-group">
                <table class="table table-condensed table-hover">
                  <tr>
                    <td>Position</td>
                    <td>Side</td>
                    <td>Direction1</td>
                    <td>Max</td>
                    <td>Direction2</td>
                    <td>Max</td>
                  </tr>
                  <tr>
                    <td>
                      <input class="form-control" type="text" name="position">
                    </td>
                    <td>
                      <input class="form-control" type="text" name="side">
                    </td>
                    <td>
                      <input class="form-control" type="text" name="direction1">
                    </td>
                    <td>
                      <input class="form-control" type="number" min="0" step="0.01" name="direction1_max">
                    </td>
                    <td>
                      <input class="form-control" type="text" name="direction2">
                    </td>
                    <td>
                      <input class="form-control" type="number" min="0" step="0.01" name="direction2_max">
                    </td>
                    <td>
                      <input type="submit" class="btn btn-success" name="name" value="Add New">
                    </td>
                  </tr>
                </table>
              </div>
            </form>
            <table class="table table-condensed table-hover">
              <tr>
                <td class="col-sm-1"></td>
                <td class="col-sm-2">Position</td>
                <td class="col-sm-2">Side</td>
                <td class="col-sm-2">Direction1</td>
                <td class="col-sm-2">Max</td>
                <td class="col-sm-2">Direction2</td>
                <td class="col-sm-2">Max</td>
                <td colspan="2" class="col-sm-1"></td>
              </tr>
              @if(count($records) > 0)
                @foreach($records as $key => $r)
                <tr>
                  <form class="form-horizontal" action="{{ url('/physical/'.$r->id)}}" method="post" role="form">
                  {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="put" />
                    <td>{{ $key+1 }}.</td>
                    <td>
                      <input class="form-control" type="text" value="{{ $r->position }}" name="position">
                    </td>
                    <td>
                      <input class="form-control" type="text" value="{{ $r->side }}" name="side">
                    </td>
                    <td>
                      <input class="form-control" type="text" value="{{ $r->direction1 }}" name="direction1">
                    </td>
                    <td>
                      <input class="form-control" type="number" min="0" step="0.01" value="{{ $r->direction1_max }}" name="direction1_max">
                    </td>
                    <td>
                      <input class="form-control" type="text" value="{{ $r->direction2 }}" name="direction2">
                    </td>
                    <td>
                      <input class="form-control" type="number" min="0" step="0.01" value="{{ $r->direction2_max }}" name="direction2_max">
                    </td>
                    <td>
                      <input type="submit" class="btn btn-success btn-block" value="Update">
                    </td>
                  </form>
                  <td>
                    <form class="form-horizontal" action="{{ url('/physical/'.$r->id)}}" method="post" role="form">
                      {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="delete" />
                      <input type="submit" class="btn btn-danger btn-block" value="Delete">
                    </form>
                  </td>
                </tr>
                @endforeach
              @endif
            </table>
        </div>
    </div>
</div>
@endsection
