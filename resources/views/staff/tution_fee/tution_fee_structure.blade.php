@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">

   @if(count($courses))
    <div class="col-md-12">
      @if(count($tutionfees))
      <div class="panel panel-default">
        <div class="panel-heading"><button class="btn btn-primary btn-block">Tuition Fee Structure({{  $activesessionid->name}})</button></div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class=" table table-bordered  table-hover" data-form="deleteForm">
                  <thead>
                    <tr>
                      <th class="text-center">Serial No.</th>
                      <th class="text-center">Session</th>
                      <th class="text-center">Course Name</th>
                      <th class="text-center">Fee</th>
                      <th class="text-center">Late Fee</th>
                      <th class="text-center">Other Fee</th>
                      <th class="text-center">Description</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = 0 ?>
                   @foreach($tutionfees as $fee)
                   <?php $i++ ?>
                    <tr class="text-center">
                        <td>{{ $i }}</td>
                        <td>{{ $fee->asessions['name'] }}</td>
                        <td>{{ $fee->courses['name'] }}</td>
                        <td><i class="fa fa-inr" aria-hidden="true"></i> {{ $fee->tution_fee }}</td> @if($fee->late_fee)
                        <td>
                         <i class="fa fa-inr" aria-hidden="true"></i> {{ $fee->late_fee }}
                        </td>
                        @else
                        <td>
                         <i class="fa fa-inr" aria-hidden="true"></i> 0
                        </td>
                        @endif
                         @if($fee->other_fee)
                        <td>
                         <i class="fa fa-inr" aria-hidden="true"></i> {{ $fee->other_fee }}
                        </td>
                        @else
                        <td>
                         <i class="fa fa-inr" aria-hidden="true"></i> 0
                        </td>
                        @endif
                       @if($fee->remarks)
                        <td>{{ $fee->remarks }}</td>
                       @else
                         <td>Monthly</td>
                       @endif
                       <td>
                            <a class="btn btn-warning btn-sm" href="/acadmic/tution_fee/{{$fee->id}}/{{strtotime($fee->created_at)}}/edit">
                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            {{ Form::model($fee, ['method' => 'delete', 'route' => ['delete_tution',$fee->id,strtotime($fee->created_at)], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
                            {{Form::hidden('id', $fee->id)}}
                            {{Form::hidden('created_at', strtotime($fee->created_at))}}
                            <button type="submit" name="delete_modal" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                           {{Form::close()}}

                         @include('staff.add.destroy_modal')
                      </td>
                    </tr>
                   @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
        @else
        <div class="text-center" style="margin-bottom: 160px; margin-top:160px;">
          <H1>No Fee Record Found</H1>
        </div>
        @endif

    </div>

   <div class="col-md-6 col-xs-10 col-xs-offset-1 col-md-offset-3">
      @include('partial.errors')
       <div class="panel panel-default">
        <div class="panel-heading"><button class="btn btn-primary btn-block">Tuition Fee Form({{  $activesessionid->name}})</button></div>
          <div class="panel-body">
            <form method="post" action="/acadmic/add/tution_fee" data-parsley-validate ="">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="course">Select Course :</label>
                <select class="form-control" id="course" name="course" required="">
                  <option value="">--Select Course</option>
                  @foreach($courses as $key=>$value)
                   @if (Input::old('course') == $key)
                   <option value="{{ $key }}" selected>{{ $value }}</option>
                   @else
                  <option value="{{ $key }}">{{ $value }}</option>
                  @endif
                  @endforeach
              </select>
                </div>

                <div class="form-group">
                  <label for="tution_fee">Fee (Monthly) :</label>
                  <input type="text" class="form-control" id="tution_fee" name="tution_fee" value="{{ old('tution_fee') }}" placeholder="Fee" required="" data-parsley-type="number">
                </div>

                <div class="form-group">
                  <label for="late_fee">Late Fee :</label>
                  <input type="text" class="form-control" id="late_fee" name="late_fee" value="{{ old('late_fee') }}" placeholder="Late Fee" data-parsley-type="number">
                </div>

                <div class="form-group">
                  <label for="other_fee">Other Fee :</label>
                  <input type="text" class="form-control" id="other_fee" name="other_fee" value="{{ old('other_fee') }}" placeholder="Other Fee" data-parsley-type="number">
                </div>

                <div class="form-group">
                 <label for="remarks">Description :</label>
                 <textarea class="form-control" rows="3" name="remarks" value="{{ old('remarks') }}"></textarea>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-plus faa-flash animated" aria-hidden="true"></i> Add Course Fee</button>
                </div>
              </form>
            </div>
          </div>
    </div>
    @else
    <div class="text-center" style="margin-bottom: 160px; margin-top:160px;">
      <H1>No Record Found. Add some course first <a href="/acadmic/courses/create">Add</a></H1>
    </div>
    @endif
 </div>

@stop

@section('script')

 <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>

  @include('staff.add.destroy_modal_javascript')

@stop
