@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@section('content')

	<div class="row">

	    <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Total Student</div>
                <div class="panel-body">
                   <h3 class="text-center {{ $totalstudent ? ' count' : '' }}">{{$totalstudent}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Total Active Student</div>
                <div class="panel-body">
                   <h3 class="text-center {{ $totalactivestudent ? ' count' : '' }}">{{$totalactivestudent}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Tuition Fee Collection</div>
                <div class="panel-body">
                   <h3 class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> 
                   {{$total_tution_fee/1000}}K
                   </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Registration Fee Collection</div>
                <div class="panel-body">
                   <h3 class="text-center">
                   <i class="fa fa-inr" aria-hidden="true"></i> 
                   {{$total_registration_fee/1000}}K
                   </h3>
                </div>
            </div>
        </div>


        @if(!$user->schoolprofile['transport_service']==0)
            
            @if(!$user->schoolprofile['hostel_service']==0)
	        <div class="col-md-3">
	        @else
            <div class="col-md-6">
            @endif
	            <div class="panel panel-primary">
	                <div class="panel-heading text-center">Transport Service Opted Student</div>
	                <div class="panel-body">
	                   <h3 class="text-center{{ $totalstudenttransport ? ' count' : '' }}">{{$totalstudenttransport}}</h3>
	                </div>
	            </div>
	        </div>

	        @if(!$user->schoolprofile['hostel_service']==0)
	        <div class="col-md-3">
	        @else
            <div class="col-md-6">
            @endif
	            <div class="panel panel-primary">
	                <div class="panel-heading text-center">Transport Fee Collection</div>
	                <div class="panel-body">
	                   <h3 class="text-center">
	                   <i class="fa fa-inr" aria-hidden="true"></i> 
	                   {{$total_transport_fee/1000}}K</h3>
	                </div>
	            </div>
	        </div>

        @endif


        @if(!$user->schoolprofile['hostel_service']==0)

	        @if(!$user->schoolprofile['transport_service']==0)
	        <div class="col-md-3">
	        @else
            <div class="col-md-6">
            @endif
	            <div class="panel panel-primary">
	                <div class="panel-heading text-center">Hostel Service Opted Student</div>
	                <div class="panel-body">
	                   <h3 class="text-center{{ $totalstudenthostel ? ' count' : '' }}">{{$totalstudenthostel}}</h3>
	                </div>
	            </div>
	        </div>

	        @if(!$user->schoolprofile['transport_service']==0)
	        <div class="col-md-3">
	        @else
            <div class="col-md-6">
            @endif
	            <div class="panel panel-primary">
	                <div class="panel-heading text-center">Hostel Fee Collection</div>
	                <div class="panel-body">
	                   <h3 class="text-center">
	                   <i class="fa fa-inr" aria-hidden="true"></i> {{$total_hostel_fee/1000}}K
	                   </h3>
	                </div>
	            </div>
	        </div>
        
        @endif
        

        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Total Teacher</div>
                <div class="panel-body">
                   <h3 class="text-center{{ $totalteacher ? ' count' : '' }}">{{$totalteacher}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Total Active Teacher</div>
                <div class="panel-body">
                   <h3 class="text-center{{ $totalactiveteacher ? ' count' : '' }}">{{$totalactiveteacher}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Total Staff</div>
                <div class="panel-body">
                   <h3 class="text-center{{ $totalstaff ? ' count' : '' }}">{{$totalstaff}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Total Active Staff</div>
                <div class="panel-body">
                   <h3 class="text-center{{ $totalactivestaff ? ' count' : '' }}">{{$totalactivestaff}}</h3>
                </div>
            </div>
        </div>


        <div class="col-md-12">
        	<div class="panel panel-primary">
		        <div class="panel-heading text-center">Students Details</div>
		        <div class="panel-body">
		              
                    @foreach($students->chunk(4) as $studentset)
                        <div class="row">
                            @foreach($studentset as $student)
		                        <div class="col-md-3">
			                        <button class="btn btn-block btn-default">
			                           {{$student->courses['name']}}
			                        </button>
			                         <div class="panel-body">
			                             <h3 class="text-center{{ $student->studentcount ? ' count' : '' }}">{{ $student->studentcount }}</h3>
			                        </div>
		                        </div>
	                        @endforeach
                        </div>
                    @endforeach

		        </div>
	        </div>
        </div>
          
    </div>
 <br><br>
@endsection

@section('script')
<script type="text/javascript">
	$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>
@stop

