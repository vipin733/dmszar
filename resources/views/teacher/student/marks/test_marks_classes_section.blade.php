@extends('layouts.app')
@section('nav')
@include('teacher.teacher_nav')
@stop
@section('content')

<div class="row">
    <div class="col-md-12">  

        @if(count($timetables))   

            <div class="panel panel-default">
                <div class="panel-heading">
                <button class="btn btn-primary btn-block">Academic Test Marks(Choose Class and section)</button>
                </div>
                <div class="panel-body">

                    <div class="table-responsive text-center col-sm-8 col-sm-offset-2">
                        <table class="table table-bordered  table-hover">
                            <thead>
                             <tr>
                            	 <th class="text-center">Serial no.</th>
                            	 <th class="text-center">Class</th>
                            	 <th class="text-center">Section</th>
                                 <th class="text-center">Upload/Edit</th>
                             </tr>
                            </thead>
                            <tbody class="text-center">
                                 <?php $i = 0 ?>
                                @foreach($timetables as $classe_section)
                                <?php $i++ ?>
                            	<tr>
                            		<td>{{ $i }}</td>
                            		<td>{{ $classe_section->courses['name'] }}</td>
                            		<td>{{ $classe_section->sections['name'] }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="/teacher/student/{{$classe_section->courses['id']}}/{{ $classe_section->sections['id'] }}/homework_subject">
                                        Action
                                        </a>
                                    </td>
                            	</tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 

                </div>
            </div>

        @else
        <h1 class="text-center">
            No Class Section Found
        </h1>     
         @endif
                      
    </div>
</div>

@stop