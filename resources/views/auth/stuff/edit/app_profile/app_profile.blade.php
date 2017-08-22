@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

    <div class="row">

      <div class="col-md-6 col-md-offset-3">       
            <div class="panel panel-default">
                <div class="panel-heading">
                  <button class="btn btn-primary btn-block">My App Profile</button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             
                               <tr>
                                 <th colspan="1" class="text-center">App Name</th>
                                 <td colspan="3" class="text-center">{{ $user->appprofile['app_name'] }}</td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">Student Registration Prefix</th>
                                 <td colspan="3" class="text-center">{{ $user->appprofile['reg_prefix_student'] }}</td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">Teacher Registration Prefix</th>
                                 <td colspan="3" class="text-center">{{ $user->appprofile['reg_prefix_teacher'] }}</td>
                               </tr>

                            </thead>                  
                        </table>
                    </div>

                    <div class="col-sm-6 col-sm-offset-3 text-center">
                      <a href="/auth/app/profile/edit" class="btn-primary btn btn-block">Edit</a>
                    </div>
                </div>
            </div> 
        </div>


  </div>

@stop       