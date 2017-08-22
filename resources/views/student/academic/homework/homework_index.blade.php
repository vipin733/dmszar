@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

    <div class="row">

		    <div class="col-md-12">       
			    <div class="panel panel-default">
			        <div class="panel-heading">
			            <button class="btn btn-primary btn-block">All Homework</button>
			        </div>
			        <div class="panel-body">

				        <div class="table-responsive text-center">
					        <table class=" table table-bordered  table-hover" id="staff_students">
					            <thead>
					                <tr>
						                <th class="text-center">Submission DateTime</th>
						                <th class="text-center">Given At</th>
						                <th class="text-center">Given By</th>
						                <th class="text-center">Subject</th>
						                <th class="text-center">View</th>
					                </tr>
					            </thead>
					            <tbody>
					                @foreach($homeworks as $homework)
						                <tr class="text-center">
						                	<td>{{ $homework->submit_at->format('d/m/Y h:i A') }}</td>
						                	<td>{{ $homework->created_at->format('d/m/Y h:i A') }}</td>
						                	<td>{{ $homework->teachers['name'] }}</td>
						                	<td>{{ $homework->subjects['name'] }}</td>
						                	<td>@include('student.academic.homework.homework_show_modal')</td>
						                </tr>
					                @endforeach
					            </tbody>
					        </table>
				        </div>

				        {{ $homeworks->links() }}

			        </div>
			    </div>
			</div>

    </div>

@stop    