@extends('layouts.app')
@section('nav')
@include('teacher.teacher_nav')
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">       
            <div class="panel panel-default">
                <div class="panel-heading">
                <button class="btn btn-primary btn-block">Academic Test Marks(Choose Subject and Action)</button>
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
                             </tr>
                          </thead>
                        </table>
                    </div>  

                    <div class="table-responsive text-center col-sm-12">
                        <table class="table table-bordered  table-hover">
                          <thead>
                             <tr>
                               <th class="text-center">Serial no.</th>
                               <th class="text-center">Subject</th>
                               <th class="text-center">Edit Test Marks</th>
                               <th class="text-center">Upload Test Marks</th>
                             </tr>
                          </thead>
                          <tbody class="text-center">
                            <?php $i = 0 ?>
                            @foreach($subjectnames as $subject)
                            <?php $i++ ?>
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $subject['name'] }}</td>
                                <td>
                                  @foreach($testnames as $testname)
                                  <a class="btn btn-warning" href="/teacher/student/{{$course['id']}}/{{strtotime($course['created_at'])}}/{{$section['id']}}/{{strtotime($section['created_at'])}}/{{$subject['id']}}/{{strtotime($subject['created_at'])}}/{{$testname['id']}}/{{strtotime($testname['created_at'])}}/test_amrks_edit">
                                    {{ $testname['name'] }}
                                  </a>
                                  @endforeach
                                </td>
                                <td>
                                  @foreach($testnames as $testname)
                                    <a class="btn btn-primary" href="/teacher/student/{{$course['id']}}/{{strtotime($course['created_at'])}}/{{$section['id']}}/{{strtotime($section['created_at'])}}/{{$subject['id']}}/{{strtotime($subject['created_at'])}}/{{$testname['id']}}/{{strtotime($testname['created_at'])}}/test_amrks_upload">{{ $testname['name'] }}
                                    </a>
                                    @endforeach
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>  

                </div>
            </div>                       
        </div>
    </div>

@stop
                           