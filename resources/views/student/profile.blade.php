@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

    <div class="row">
       <div class="col-sm-10 col-sm-offset-1">
          <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">My Profile Info.</button></div>
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
                                 <th class="text-center">Name</th>
                                 <td class="text-center">{{ $user->name }}</td>
                                 <th class="text-center">Current Course</th>
                                 <td class="text-center">{{ $user->courses['name'] }}</td>
                               </tr>

                               <tr>
                                 <th class="text-center">Admission Course</th>
                                 <td class="text-center">
                                  {{ $user->created_courses['name'] }}
                                 </td>
                                 <th class="text-center">Date of Admission</th>
                                 <td class="text-center">
                                 {{ $user->date_of_admission->format('d/m/Y') }}
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Last School</th>
                                 <td class="text-center">
                                 @if($user->last_school)
                                 {{ $user->last_school }}
                                 @else
                                 N/A
                                 @endif
                                 </td>
                                 <th class="text-center">Hostel Taken</th>
                                 <td class="text-center">
                                 	@if($user->HostelTaken())
                                 	Yes
                                 	@else
                                 	No
                                 	@endif
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Transportation Taken</th>
                                 <td class="text-center">
                                   @if($user->TransportationTaken())
                                 	Yes
                                 	@else
                                 	No
                                 	@endif 
                                 </td>
                                 <th class="text-center">Transportation Stoppage</th>
                                 <td class="text-center">
                                 @if($user->stopages)
                                 {{ $user->stopages['name'] }}
                                 @else
                                 N/A
                                 @endif
                                 </td>
                               </tr>

                            </thead>                  
                        </table>
                      </div>
                </div>
           </div>        
       </div>

        <div class="col-sm-10 col-sm-offset-1">
          <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">My Personal Info.</button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             <tr>
                                 <th class="text-center">Father Name</th>
                                 <td class="text-center">{{ $user->father_name }}</td>
                                 <th class="text-center">Mother Name</th>
                                 <td class="text-center">{{ $user->mother_name }}</td>
                              </tr>

                               <tr>
                                 <th class="text-center">Date Of Birth</th>
                                 <td class="text-center">
                                 {{ $user->date_of_birth->format('d/m/Y') }}
                                 </td>
                                 <th class="text-center">Gender</th>
                                 <td class="text-center">
                                 @if($user->gender == 1)
                                 Male
                                 @elseif($user->gender == 2)
                                 Female
                                 @else
                                 Other
                                 @endif
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Religion</th>
                                 <td class="text-center">
                                  {{ $user->religion }}
                                 </td>
                                 <th class="text-center">Category</th>
                                 <td class="text-center">
                                 {{ $user->castec }}
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Caste</th>
                                 <td class="text-center">{{ $user->caste }}</td>
                                 <th class="text-center">Father Occupation</th>
                                 <td class="text-center">
                                  {{$user->occupation}}
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Emergency No</th>
                                 <td class="text-center">
                                  {{ $user->emer_no }}
                                 </td>
                                 <th class="text-center">Parent's Mo. No.</th>
                                 <td class="text-center">
                                 @if($user->parent_no)
                                 {{ $user->parent_no}}
                                 @else
                                 N/A
                                 @endif
                                 </td>
                               </tr>
                               <tr>
                                 <th colspan="2" class="text-center">Parent's Email</th>
                                 <td colspan="2" class="text-center">
                                  @if($user->parent_email)
                                  {{ $user->parent_email }}
                                  @else
                                  N/A
                                  @endif
                                 </td>
                               </tr>

                            </thead>                  
                        </table>
                      </div>
                </div>
           </div>        
       </div>

       <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">My Address Info.</button></div>
                <div class="panel-body">
                  
                  <div class="col-sm-6">
                  	<h4>Permanent Address</h4>
                  	<address>
                  		{{ $user->permanent_address }}, {{ $user->permanent_district['name']}}<br>
                  		{{ $user->permanent_states['name'] }}, {{ $user->permanent_zip_pin }}
                  	</address>
                  </div>

                  <div class="col-sm-6">
                  	<h4>Communication Address</h4>
                  	<address>
                  		{{ $user->communication_address }}, {{ $user->communication_district['name']}}<br>
                  		{{ $user->communication_states['name'] }}, {{ $user->communication_zip_pin }}
                  	</address>
                  </div>
                    
                </div>
           </div>        
       </div>

       <div class="col-md-10 col-md-offset-1">
       	<button class="btn btn-warning btn-block btn-xs"><b>Note</b></button>
       <p style="text-align: justify;">If any information is not correct then you can contact Record Cell, office with id proof & copy of relevant document or send email at <b>{{ $user->owner['email'] }}</b> with scan copies of the relevant documents for rectification.</p>
       </div>
 </div>

@endsection   

                      