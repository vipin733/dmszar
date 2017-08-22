@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

<div class="row">

    <div class="col-md-10 col-md-offset-1">       
            <div class="panel panel-default">
                <div class="panel-heading">
                  <button class="btn btn-primary btn-block">My School Profile</button>
                </div>
                <div class="panel-body">

                  <div class="col-sm-2 col-sm-offset-5 text-center">
                      <a href="#" class="thumbnail">
                      @if($user->schoolprofile['logo'])
                       <img src="{{ $user->schoolprofile['logo'] }}" class="img-responsive img-rounded" alt="{{$user->name}}">
                       @else
                       <img src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/no-image-found.jpg" class="img-responsive img-rounded" alt="{{$user->name}}">
                       @endif
                      </a>
                      @include('auth.stuff.edit.school_profile.logo_modal')
                      <br> 
                  </div>
                                    
                  <div class="col-sm-12">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             
                               <tr>
                                 <th colspan="1" class="text-center">School Name</th>
                                 <td colspan="3" class="text-center">
                                     {{ $user->schoolprofile['school_name'] }}
                                 </td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">School Board Name</th>
                                 <td colspan="3" class="text-center">
                                  @if($user->schoolprofile['school_board_id'])
                                     {{  $user->schoolprofile->schoolboards['name'] }}
                                   @else
                                   N/A
                                   @endif
                                 </td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">School Affiliation No</th>
                                 <td colspan="3" class="text-center">
                                   @if($user->schoolprofile['affiliation_no'])
                                     {{  $user->schoolprofile['affiliation_no'] }}
                                   @else
                                   N/A
                                   @endif
                                 </td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">School Code No</th>
                                 <td colspan="3" class="text-center">
                                   @if($user->schoolprofile['school_code_no'])
                                     {{  $user->schoolprofile['school_code_no'] }}
                                    @else
                                    N/A
                                    @endif 
                                 </td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">School Website</th>
                                 <td colspan="3" class="text-center">
                                 @if($user->schoolprofile['website'])
                                     {{  $user->schoolprofile['website'] }}
                                  @else
                                  N/A
                                  @endif   
                                 </td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">School Email</th>
                                 <td colspan="3" class="text-center">
                                  @if($user->schoolprofile['school_email'])
                                     {{  $user->schoolprofile['school_email'] }}
                                   @else
                                   N/A
                                   @endif  
                                 </td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">School Telephone No</th>
                                 <td colspan="3" class="text-center">
                                  @if($user->schoolprofile['telephone_no'])
                                     {{  $user->schoolprofile['telephone_no'] }}
                                    @else
                                    N/A
                                    @endif 
                                 </td>
                               </tr>


                               <tr>
                                 <th colspan="1" class="text-center">School Mobile No</th>
                                 <td colspan="3" class="text-center">
                                    @if($user->schoolprofile['mobile_no'])
                                     +91{{  $user->schoolprofile['mobile_no'] }}
                                     @else
                                     N/A
                                     @endif
                                 </td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">School Address</th>
                                 <td colspan="3" class="text-center">
                                  @if($user->schoolprofile['school_address'])
                                   {{ $user->schoolprofile['school_address'] }}, {{ $user->schoolprofile['city'] }}, {{ $user->schoolprofile->appdistricts['name'] }}, {{$user->schoolprofile->states['name']}}, {{$user->schoolprofile['pincode']}}
                                   @else
                                   N/A
                                   @endif
                                 </td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">Campus Type</th>
                                 <td colspan="3" class="text-center">
                                    @if($user->schoolprofile['campuse_type'])
                                      @if($user->schoolprofile['campuse_type'] == 1)
                                      Boys
                                      @elseif($user->schoolprofile['campuse_type'] == 2)
                                      Girls
                                      @else
                                      Both
                                      @endif
                                    @else
                                    N/A
                                    @endif  
                                 </td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">This is main campus</th>
                                 <td colspan="3" class="text-center">
                                  @if($user->schoolprofile['main_campuse'])
                                   @if($user->schoolprofile['main_campuse'] == 1)
                                    Yes
                                    @else
                                    NO
                                    @endif
                                    @else
                                    N/A
                                    @endif
                                 </td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">Hostel Service Provide</th>
                                 <td colspan="3" class="text-center">
                                  @if($user->schoolprofile['hostel_service'])
                                    @if($user->schoolprofile['hostel_service'] == 1)
                                    Yes
                                    @else
                                    NO
                                    @endif
                                  @else
                                  N/A
                                  @endif  
                                 </td>
                               </tr>

                              @if($user->schoolprofile['hostel_service'] == 1)
                                <tr>
                                   <th colspan="1" class="text-center">Hostel Service Type</th>
                                   <td colspan="3" class="text-center">
                                    
                                      @if($user->schoolprofile['hostel_type'] == 1)
                                      Boys
                                      @elseif($user->schoolprofile['hostel_type'] == 2)
                                      Girls
                                      @else
                                      Both
                                      @endif
                                   
                                     
                                   </td>
                                 </tr>
                               @endif
                                  
                               <tr>
                                 <th colspan="1" class="text-center">Transport Service Provide</th>
                                 <td colspan="3" class="text-center">
                                  @if($user->schoolprofile['transport_service'])
                                   @if(!$user->schoolprofile['transport_service'] == 0)
                                    Yes
                                    @else
                                    NO
                                    @endif
                                  @else
                                  N/A
                                  @endif  
                                 </td>
                               </tr>

                            </thead>                  
                        </table>
                    </div>
                  </div>  

                  <div class="col-sm-6 col-sm-offset-3 text-center">
                    	<a href="/auth/school_profile/edit" class="btn-primary btn btn-block">Edit</a>
                  </div>
                  
                </div>
            </div> 
      </div>

   </div>
   
@stop          
