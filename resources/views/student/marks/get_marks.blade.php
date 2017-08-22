@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

  <div class="row">

    <div class="col-md-12">

	  {{--   <div class="text-center">
	    	<div class="dropdown btn-group">
		    <a class="btn dropdown-toggle btn-primary" data-toggle="dropdown" href="#">
		      --Select Class
		    </a>
		    <ul class="dropdown-menu">
		      <li><a href="#">V</a></li>
		      <li><a href="#">VI</a></li>
		      <li><a href="#">VII</a></li>
		      <li><a href="#">VIII</a></li>
		    </ul>
		  </div>
	    </div>
        <br> --}}
        <div class="panel panel-default">
		  <div class="panel-heading">
			  <button class="btn btn-primary btn-block">
			  <b>(Session: {{ $asessionid->name }})</b>
			  </button>
		  </div>
		  <div class="panel-body">

		     <div class="col-sm-12">
			    <div class="table-responsive">
			        <table class=" table table-bordered  table-hover">
			            <thead >  
			                 <tr>
				                <th rowspan="2" class="text-center">Subject</th>
				                 @foreach($testnames as $testname)
				                 <th colspan="2" class="text-center">{{ $testname->testnames['name'] }}</th>
				                 @endforeach
				                 @foreach($examnames as $examname)
				                 <th colspan="2" class="text-center">{{ $examname->examnames['name'] }}
				                </th>
				                 @endforeach		                
			                 </tr> 
			                 <tr>
			                 @foreach($testnames as $testname)
			                 	<th class="text-center">Max. Mark</th>
			                 	<th class="text-center">Obt. Mark</th>
			                 @endforeach 
			                 @foreach($examnames as $examname)	
			                 	<th class="text-center">Max. Mark</th>
			                 	<th class="text-center">Obt. Mark</th>
			                 @endforeach			                 
			                 </tr> 			                                   
			            </thead>
			            <tbody >

			              @foreach($subjects as $subject)
			             	<tr >			             	  
			             	 <td class="text-center">{{ $subject['name'] }}</td>
			             	 @foreach($subject->testmarks as $testmark)
			             	 <td class="text-center">{{ $testmark['max_mark'] }}</td>
			             	 <td class="text-center">{{ $testmark['score_mark'] }}</td>
			             	 @endforeach
			             	 @foreach($subject->exammarks as $exammark)
			             	 <td class="text-center">{{ $exammark['max_mark'] }}</td>
			             	 <td class="text-center">{{ $exammark['score_mark'] }}</td>
			             	 @endforeach			  
			             	</tr>
			               @endforeach           		
			             		
			            </tbody>
			        </table>          
			    </div>
			  </div>
			    
	       </div>
	    </div>
            <button class="btn btn-warning btn-xs btn-block"><b>Disclaimer</b></button>
            <p style="text-align: justify;">This result is issued on the basis of information available in the office of records on the date of its issue and the University reserves the right to update/change any information contained here in without further notice. The University expressly disclaims all obligations to confirm the accuracy of any of the particulars in this result based upon information submitted by the candidate. For any Result/Mapping query Consult Examination Division.</p>
    </div>
  </div>

  @stop

  