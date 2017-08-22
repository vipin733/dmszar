@extends('layouts.app')
@section('nav')
@if(Auth::guard('teacher')->check())
@include('staff.staff_nav')
@else
@include('layouts.nav')
@endif
@stop
@section('content')

  <div class="row">   
    <div class="col-md-2 col-md-offset-5">
        <a href="#" class="thumbnail">
          @if($teacher->avatar)
            <img src="{{ $teacher->avatar }}" class="img-responsive img-rounded" alt="{{$teacher->name}}">
          @else
            <img src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/student_male.png" class="img-responsive img-rounded" alt="{{$teacher->name}}">
          @endif
        </a>
    </div>
  </div>  

  <div class="row">

    <div class="col-md-1">
        @include('staff.teachers_staff.profile.teacher_staff_nav')  
    </div> 
          @include('staff.teachers_staff.profile.message.message_modal')
    <div class="col-md-11">

        <div class="col-sm-10 col-sm-offset-1">
          <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">
                @if($teacher->isStaff())
                Staff Profile Info.
                @else
                Teacher Profile Info.
                @endif
              </button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             <tr>
                                 <th class="text-center">Registration no.</th>
                                 <td class="text-center">{{ $teacher->reg_no }}</td>
                                 <th class="text-center">Status</th>
                                 <td class="text-center">
                                 @if($teacher->isActive())
                                 Active
                                 @else
                                 De-active
                                 @endif
                                 </td>
                              </tr>

                               <tr>
                                 <th class="text-center">Name</th>
                                 <td class="text-center">{{ $teacher->name }}</td>
                                 <th class="text-center">Mob. NO.</th>
                                 <td class="text-center">{{ $teacher->mob_no }}</td>
                               </tr>

                               <tr>
                                 <th class="text-center">Last School</th>
                                 <td class="text-center">
                                 @if($teacher->last_school)
                                  {{ $teacher->last_school }}
                                  @else
                                  N/A
                                  @endif
                                 </td>
                                 <th class="text-center">Experience</th>
                                 <td class="text-center">
                                 @if($teacher->experience)
                                 {{ $teacher->experience }}
                                 @else
                                 N/A
                                 @endif
                                 </td>
                               </tr>


                               <tr>
                                 <th class="text-center">Transportation Taken</th>
                                 <td class="text-center">
                                   @if($teacher->TransportationTaken())
                                 	Yes
                                 	@else
                                 	No
                                 	@endif
                                 </td>
                                 <th class="text-center">Transportation Stoppage</th>
                                 <td class="text-center">
                                 @if($teacher->stopages)
                                 {{ $teacher->stopages['name'] }}
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
              <div class="panel-heading"><button class="btn btn-primary btn-block">
              @if($teacher->isStaff())
                Staff Personal Info.
                @else
                Teacher Personal Info.
                @endif 
              </button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             <tr>
                                 <th class="text-center">Father Name</th>
                                 <td class="text-center">{{ $teacher->father_name }}</td>
                                 <th class="text-center">Mother Name</th>
                                 <td class="text-center">{{ $teacher->mother_name }}</td>
                              </tr>

                               <tr>
                                 <th class="text-center">Date Of Birth</th>
                                 <td class="text-center">
                                 {{ $teacher->date_of_birth->format('d/m/Y') }}
                                 </td>
                                 <th class="text-center">Gender</th>
                                 <td class="text-center">
                                 @if($teacher->gender == 1)
                                 Male
                                 @elseif($teacher->gender == 2)
                                 Female
                                 @else
                                 Other
                                 @endif
                                 </td>
                               </tr>

                               <tr>
                               <th class="text-center">Date Of Joining</th>
                                 <td class="text-center">{{ $teacher->date_of_joining->format('d/m/Y')}}</td>
                                 <th class="text-center">Emergency No</th>
                                 <td class="text-center">
                                  {{ $teacher->emergency_no }}
                                 </td>
                                </tr>

                               <tr>
                                 <th colspan="2" class="text-center">Email</th>
                                 <td colspan="2" class="text-center">
                                 @if($teacher->email)
                                  {{ $teacher->email }}
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
              <div class="panel-heading"><button class="btn btn-primary btn-block">
              @if($teacher->isStaff())
                 Staff Address Info.
                @else
                 Teacher Address Info.
                @endif
              </button></div>
                <div class="panel-body">

                  <div class="col-sm-6">
                  	<h4>Permanent Address</h4>
                  	<address>
                  		{{ $teacher->permanent_address }}, {{ $teacher->permanent_district['name']}}<br>
                  		{{ $teacher->permanent_states['name'] }}, {{ $teacher->permanent_zip_pin }}
                  	</address>
                  </div>

                  <div class="col-sm-6">
                  	<h4>Communication Address</h4>
                  	<address>
                  		{{ $teacher->communication_address }}, {{ $teacher->communication_district['name']}}<br>
                  		{{ $teacher->communication_states['name'] }}, {{ $teacher->communication_zip_pin }}
                  	</address>
                  </div>

                </div>
           </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <button class="btn btn-primary btn-block">
                  @if($teacher->isStaff())
                   Staff Bio.
                  @else
                   Teacher Bio.
                  @endif
              </button>
            </div>
            <div class="panel-body">            
             <p>{{ $teacher->bio }}</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-md-offset-4">
          <a href="/st/teacher/profile/{{$teacher->uuid}}/{{$teacher->reg_no}}/update" class="btn btn-primary btn-block btn-lg">Update Profile</a>
          <br>
        </div>

    </div>   
  </div>

@endsection

@section('script')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
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
