@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

    <div class="row">
       
       @include('staff.teachers_staff.profile.profile_detail')
	    
    </div>

    <div class="row">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	         <button class="btn btn-primary btn-block">
	            Teacher Last Class Teacher Detail
	         </button>
	        </div>
	        <div class="panel-body">
		        <div class="table-responsive">
		            <table class=" table table-bordered  table-hover" id="userstable">
			            <thead>
			              <tr>
			                <th class="text-center">Serial No.</th>
			                <th class=" text-center">Class Teacher of</th>
			                <th class=" text-center">Section</th>
			                <th class=" text-center">Session</th>
			                <th class=" text-center">Teaching Subject</th>
			              </tr>
			            </thead>
			            <tbody class="text-center">
			              <?php $i = 0 ?>
			              @foreach($teacheracadmics as $teacheracadmic)
			                <?php $i++ ?>
			                <tr>

			                    <td>{{ $i }}</td>
			                    <td>{{ $teacheracadmic->courses['name'] or '' }}</td>
                                <td>{{ $teacheracadmic->sections['name'] or '' }}</td>
                                <td>{{ $teacheracadmic->asessions['name'] or '' }}</td>
                                <td>
                                	@foreach($teacheracadmic->teachers->subjects as $subject)
                                   
                                     @if(!$loop->last)
                                       {{ $subject->name }},
                                    @else
                                       {{ $subject->name }}
                                     @endif
                                   
                                   @endforeach
                                </td>
			                    
			                </tr>
			              @endforeach  
			            </tbody>
		            </table>
		        </div>

	        </div>
	    </div>
    </div>

@endsection
