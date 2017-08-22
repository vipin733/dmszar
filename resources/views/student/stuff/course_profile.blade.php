@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

<div class="row">
      
            <div class="col-sm-10 col-sm-offset-1">
             <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">My Academic Profile</button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             <tr>
                                 <th class="text-center">Registration no.</th>
                                 <td class="text-center">{{ $user->reg_no }}</td>
                                 <th class="text-center">Status</th>
                                 <td class="text-center">
                                 @if($user->isActive())
                                 Active
                                 @else
                                 De-active
                                 @endif
                                 </td>
                              </tr>

                               <tr>
                                 <th class="text-center">Current Class</th>
                                 <td class="text-center">
                                 {{ $studentacadmic->courses['name'] or ''}}
                                 </td>
                                 <th class="text-center">Promoted Date</th>
                                 <td class="text-center">
                                  @if($studentacadmic) 
                                  {{$studentacadmic['created_at']->format('d/m/Y')}}
                                  @endif
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Section</th>
                                 <td class="text-center">
                                  {{ $studentacadmic->sections['name'] or ''}}
                                 </td>
                                 <th class="text-center">Date of Admission</th>
                                 <td class="text-center">
                                 {{ $user->date_of_admission->format('d/m/Y') }}
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Class Teacher</th>
                                 <td class="text-center"> 
                                   {{  $studentacadmic->courses->teacheracadmic->teachers['name'] or 'N/A'}}
                                 </td>
                                 <th class="text-center">Current Session</th>
                                 <td class="text-center">
                                 	{{  $asession['name'] or ''}}
                                 </td>
                               </tr>

                               <tr>
                                  <tr>
                                 <th colspan="1" class="text-center">Subjects</th>
                                 <td colspan="3" class="text-center">
                                  @if($studentacadmic) 
                                   @foreach($studentacadmic->courses->subjects as $subject)
                                   
                                     @if(!$loop->last)
                                    {{ $subject->name }},
                                    @else
                                     {{ $subject->name }}
                                     @endif

                                   @endforeach
                                 
                                 @endif
                                 </td>
                               </tr>
                               </tr>

                            </thead>                  
                        </table>
                      </div>
                </div>
           </div> 
               <button class="btn btn-warning btn-xs btn-block"><b>Disclaimer</b></button>
            <p style="text-align: justify;">This result is issued on the basis of information available in the office of records on the date of its issue and the School reserves the right to update/change any information contained here in without further notice. The School expressly disclaims all obligations to confirm the accuracy of any of the particulars in this result based upon information submitted by the candidate. For any Result/Mapping query Consult School Admin.</p>       
       </div>
   
    </div>
@stop