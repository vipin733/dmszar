@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

<div class="row">

      <div class="col-sm-2 col-sm-offset-5">
        <a href="#" class="thumbnail">
        @if($student->avatar)
        <img src="{{ $student->avatar }}" class="img-responsive img-rounded" alt="{{$student->name}}">
        @else
          <img src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/student_male.png" class="img-responsive img-rounded" alt="{{$student->name}}">
        @endif  
        </a>
      </div>
</div>

<div class="row">    

<div class="col-md-1">
      @include('auth.students.profile.student_profile_nav')  
  </div>   

       <div class="col-md-11">
          <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">Student Academic Profile Info.</button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             <tr>
                                 <th class="text-center">Registration no.</th>
                                 <td class="text-center">{{ $student->reg_no }}</td>
                                 <th class="text-center">Status</th>
                                 <td class="text-center">
                                 @if($student->isActive())
                                 Active
                                 @else
                                 De-active
                                 @endif
                                 </td>
                              </tr>

                               <tr>
                                 <th class="text-center">Name</th>
                                 <td class="text-center">{{ $student->name }}</td>
                                 <th class="text-center">Current Class</th>
                                 <td class="text-center">{{ $student->courses['name'] }}</td>
                               </tr>

                               <tr>
                                 <th class="text-center">Admission Class</th>
                                 <td class="text-center">
                                  {{ $student->created_courses['name'] }}
                                 </td>
                                 <th class="text-center">Date of Admission</th>
                                 <td class="text-center">
                                 {{ $student->date_of_admission->format('d/m/Y') }}
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Last School</th>
                                 <td class="text-center">
                                 @if($student->last_school)
                                  {{ $student->last_school }}
                                 @else
                                  N/A
                                 @endif 
                                 </td>
                                 <th class="text-center">Hostel Taken</th>
                                 <td class="text-center">
                                 	@if($student->HostelTaken())
                                 	Yes
                                 	@else
                                 	No
                                 	@endif
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Transportation Taken</th>
                                 <td class="text-center">
                                   @if($student->TransportationTaken())
                                 	Yes
                                 	@else
                                 	No
                                 	@endif 
                                 </td>
                                 <th class="text-center">Transportation Stoppage</th>
                                 <td class="text-center">
                                 @if($student->stopages)
                                 {{ $student->stopages['name'] }}
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
              <div class="panel-heading"><button class="btn btn-primary btn-block">Student Personal Info.</button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             <tr>
                                 <th class="text-center">Father Name</th>
                                 <td class="text-center">{{ $student->father_name }}</td>
                                 <th class="text-center">Mother Name</th>
                                 <td class="text-center">{{ $student->mother_name }}</td>
                              </tr>

                               <tr>
                                 <th class="text-center">Date Of Birth</th>
                                 <td class="text-center">
                                 {{ $student->date_of_birth->format('d/m/Y') }}
                                 </td>
                                 <th class="text-center">Gender</th>
                                 <td class="text-center">
                                 @if($student->gender == 1)
                                 Male
                                 @elseif($student->gender == 2)
                                 Female
                                 @else
                                 Other
                                 @endif
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Religion</th>
                                 <td class="text-center">
                                  {{ $student->religion }}
                                 </td>
                                 <th class="text-center">Category</th>
                                 <td class="text-center">
                                 {{ $student->castec }}
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Caste</th>
                                 <td class="text-center">{{ $student->caste }}</td>
                                 <th class="text-center">Father Occupation</th>
                                 <td class="text-center">
                                  {{$student->occupation}}
                                 </td>
                               </tr>

                               <tr>
                                 <th class="text-center">Emergency No</th>
                                 <td class="text-center">
                                  {{ $student->emer_no }}
                                 </td>
                                 <th class="text-center">Parent's Mo. No.</th>
                                 <td class="text-center">
                                 @if($student->parent_no)
                                 {{ $student->parent_no}}
                                 @else
                                 N/A
                                 @endif
                                 </td>
                               </tr>
                               <tr>
                                 <th colspan="2" class="text-center">Parent's Email</th>
                                 <td colspan="2" class="text-center">
                                 @if($student->parent_email)
                                  {{ $student->parent_email }}
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
              <div class="panel-heading"><button class="btn btn-primary btn-block">Student Address Info.</button></div>
                <div class="panel-body">
                  
                  <div class="col-sm-6">
                  	<h4>Permanent Address</h4>
                  	<address>
                  		{{ $student->permanent_address }}, {{ $student->permanent_district['name']}}<br>
                  		{{ $student->permanent_states['name'] }}, {{ $student->permanent_zip_pin }}
                  	</address>
                  </div>

                  <div class="col-sm-6">
                  	<h4>Communication Address</h4>
                  	<address>
                  		{{ $student->communication_address }}, {{ $student->communication_district['name']}}<br>
                  		{{ $student->communication_states['name'] }}, {{ $student->communication_zip_pin }}
                  	</address>
                  </div>
                    
                </div>
           </div>        
       </div>
       
       <div class="col-md-4 col-md-offset-4">
       	<a href="/student/profile/{{$student->uuid}}/{{$student->reg_no}}/update" class="btn btn-primary btn-block btn-lg">Update Profile</a>
       	<br>
       </div>
 </div>

@stop 

@section('script')
  <script type="text/javascript">
    function openNav() {
    document.getElementById("ddmySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("ddmySidenav").style.width = "0";
}
  </script>
@stop
