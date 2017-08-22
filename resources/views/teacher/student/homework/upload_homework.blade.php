@extends('layouts.app')
@section('nav')
@include('teacher.teacher_nav')
@stop
@section('content')
    <div class="row">

      <div class="col-md-12">       
        <div class="panel panel-default">
            <div class="panel-heading">
            <button class="btn btn-primary btn-block">Academic Upload Homework Details</button>
            </div>
            <div class="panel-body">
                <div class="table-responsive text-center col-sm-12">
                    <table class="table table-bordered  table-hover">
                      <thead>
                         <tr>
                           <th class="text-center">Class</th>
                           <td class="text-center">{{$course->name}}</td>
                           <th class="text-center">Section</th>
                           <td class="text-center">{{$section->name}}</td>
                           <th class="text-center">Subject</th>
                           <td class="text-center">{{$subject->name}}</td>
                           <th class="text-center">View All Homework</th>
                           <td class="text-center">
                              <a class="btn-primary btn btn-xs" href="/teacher/student/homework_index">
                                <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                              </a>
                           </td>
                         </tr>
                      </thead>
                    </table>
                </div> 
            </div>
          </div>                       
      </div>

      <div class="col-md-6">  

        <div class="panel panel-default">
          <div class="panel-heading">
            <button class="btn btn-primary btn-block">Academic Upload Homework Form</button>
          </div>
          <div class="panel-body">   
            <form action="/teacher/student/{{$course->id}}/{{$section->id}}/{{$subject->id}}/homework_upload" method="post" data-parsley-validate ="">
            {{ csrf_field() }}

              <div class="form-group">
                <label for="homework">Homework Details</label>
                <textarea type="text" class="form-control" id="homework" name="homework" required="">{{ old('homework') }}</textarea>
              </div>

              <div class="form-group">
                <label for="remarks">Remarks(if any)</label>
                <textarea type="text" class="form-control" id="remarks" name="remarks">{{ old('remarks') }}</textarea>
              </div>
               
              <div class="form-group">
                <label for="submission_date_time">Submission Date Time</label>
                <input class="form-control" id="submission_date_time" name="submission_date_time" value="{{ old('submission_date_time') }}" required=""></input>
              </div>
          
              <div class="col-sm-6 col-sm-offset-3">
                <button class="btn btn-success btn-block">Submit</button>
              </div>
               
            </form>
          </div>  
        </div>    
      </div>    


      <div class="col-md-6">
       @foreach($homeworks as $homework)
          
        <div class="panel panel-default">
          <div class="panel-body">
            <p>{{ $homework->homework }}</p>
            @if($homework->remarks)
            <p style="font-style: italic;"><b>{{ $homework->remarks}}</b></p>
            @endif
          </div>
          <div class="panel-footer">         
              <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#d{{$homework->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i>
              </button>
            @include('teacher.student.homework.delete_homework_modal')
              <button type="button" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#c{{$homework->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </button>
            @include('teacher.student.homework.edit_homework_modal')

            <p class="">Submission DateTime: {{ $homework->submit_at->format('d/m/y h:i A') }}</p>
            <p class="">Given At: {{ $homework->created_at->format('d/m/y h:i A') }}</p>

          </div>
        </div> 

       @endforeach 
      </div>    

    </div>

@stop

@section('script')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
 <script type="text/javascript">

     $(function () {
        $('#submission_date_time').datetimepicker({
           format: 'DD/MM/YYYY LT'
        });

        $('#submission_date_time_edit').datetimepicker({
           format: 'DD/MM/YYYY LT'
        });
    });

</script>

@stop 
                           