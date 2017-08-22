@extends('layouts.app')
@section('nav')
@if(Auth::user()->isStaff())
@include('staff.staff_nav')
@else
@include('teacher.teacher_nav')
@endif
@stop
@section('content')

<div class="row">
      
  <div class="col-sm-10 col-sm-offset-1">
    <div class="panel panel-default">
              <div class="panel-heading">
               <button class="btn btn-primary btn-block">Course Profile({{ $studentacadmic->students['name'] }})
               </button>
              </div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             <tr>
                                 <th class="text-center">Registration no.</th>
                                 <td class="text-center">
                                 <a href="/st/student/{{$studentacadmic->students['reg_no']}}">
                                 {{ $studentacadmic->students['reg_no'] }}
                                 </a>
                                 </td>
                                 <th class="text-center">Status</th>
                                 <td class="text-center">
                                 @if($studentacadmic->students->isActive())
                                 Active
                                 @else
                                 De-active
                                 @endif
                                 </td>
                              </tr>

                               <tr>
                                 <th class="text-center">Current Course</th>
                                 <td class="text-center">{{ $studentacadmic->courses['name'] }}</td>
                                 <th class="text-center">Promoted Date</th>
                                 <td class="text-center">
                                  {{$studentacadmic['created_at']->format('d/m/Y')}}
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Section</th>
                                 <td class="text-center">
                                  {{ $studentacadmic->sections['name'] or ''}}
                                 </td>
                                 <th class="text-center">Date of Admission</th>
                                 <td class="text-center">
                                 {{ $studentacadmic->students['date_of_admission']->format('d/m/Y') }}
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Class Teacher</th>
                                 <td class="text-center">
                                 {{  $studentacadmic->courses->teacheracadmic->teachers['name'] or '' }}
                                 </td>
                                 <th class="text-center">Current Session</th>
                                 <td class="text-center">
                                 	{{  $activesessionid['name'] or '' }}
                                 </td>
                               </tr>

                               <tr>
                                  <tr>
                                 <th colspan="1" class="text-center">Subjects</th>
                                 <td colspan="3" class="text-center">
                                 @foreach($studentacadmic->courses->subjects as $subject)
                                 
                                   @if(!$loop->last)
                                  {{ $subject->name }},
                                  @else
                                   {{ $subject->name }}
                                   @endif

                                 @endforeach
                                 </td>
                               </tr>
                               </tr>

                            </thead>                  
                        </table>
                      </div>
                </div>
           </div>    
       </div>
   
    </div>

@stop    