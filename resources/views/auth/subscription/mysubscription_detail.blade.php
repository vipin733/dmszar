@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

    <div class="row">

        <div class="col-md-6 col-md-offset-3">       
            <div class="panel panel-default">
                <div class="panel-heading">
                  <button class="btn btn-primary btn-block">My Subscription</button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             <tr>
                                 <th colspan="1" class="text-center">Plan</th>
                                 <td colspan="3" class="text-center">
                                  @if($user->plan == 0)
                                   Basic
                                   @else
                                   Professional
                                   @endif
                                 </td>
                               </tr>

                               <tr>
                                 <th colspan="1" class="text-center">Date of Registration</th>
                                 <td colspan="3" class="text-center">
                                  {{ $user->created_at->format('d/m/Y') }}
                                 </td>
                                 
                               </tr>
                                
	                               <tr>
	                                 <th colspan="1" class="text-center">Trial End At</th>
	                                 <td colspan="3" class="text-center">
	                                   {{ $user->trial_end_at->format('d/m/Y') }}
	                                 </td>
	                               </tr>

                                <tr>
                                 <th colspan="1" class="text-center">Status</th>
                                 <td colspan="3" class="text-center">
                                 	@if($user->isActive())
	                                 Active
	                                 @else
	                                 De-active
	                                 @endif
                                 </td>
                               </tr>
                               
                           </thead>                  
                        </table>
                    </div>

                    <div class="col-sm-6 col-sm-offset-3 text-center">
                    	<a href="" class="btn-primary btn btn-block" data-toggle="modal" data-target="#update">Update Plan</a>
                      @include('auth.subscription.mysubscription_detail_modal')
                    </div>
                </div>
            </div> 
        </div>

  </div>

@stop    


@section('script')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
@stop