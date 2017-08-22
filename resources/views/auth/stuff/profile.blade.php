@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

    <div class="row">

        <div class="col-md-6 col-md-offset-3">       
            <div class="panel panel-default">
                <div class="panel-heading">
                  <button class="btn btn-primary btn-block">My Profile</button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             
                               <tr>
                                 <th colspan="1" class="text-center">Name</th>
                                 <td colspan="3" class="text-center">{{ Auth::user()->name }}</td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">Email</th>
                                 <td colspan="3" class="text-center">{{ Auth::user()->email }}</td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">Mobile No.</th>
                                 <td colspan="3" class="text-center">+91{{ Auth::user()->mobile_no }}</td>
                               </tr>
                             
                            </thead>                  
                        </table>
                    </div>

                    <div class="col-sm-6 col-sm-offset-3 text-center">
                    	@include('auth.stuff.edit.modal.edit_personal_profile_modal')
                    </div>
                </div>
            </div> 
        </div>

  </div>

@stop    

 