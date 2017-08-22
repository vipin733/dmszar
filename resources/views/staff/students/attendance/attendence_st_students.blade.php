@extends('layouts.app')
@section('nav')
@if(Auth::user()->isStaff())
@include('staff.staff_nav')
@else
@include('teacher.teacher_nav')
@endif
@stop
@section('content')

<div class="row">

       <div class="col-md-8 col-md-offset-2">
        <div class="table-responsive">
          <table class=" table table-bordered  table-hover">
                    <thead>
                      <tr>
                        <th class="text-center">Reg. No.</th>
                        <th class="text-center">Student Name</th>
                        <th class="text-center">Father Name</th>
                        @if($user->isActive())
                        <th class="text-center">Pay Tuition Fee</th>
                        @else
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="text-center">
                          <td>{{ $user->reg_no }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->father_name }}</td>
                          @if($user->isActive())
                          <td>
                            <div class="text-center">
                             <a class="btn btn-success" href="/student/{{$user->reg_no}}/{{$user->uuid}}/tution_fee/take"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                             </a>
                            </div>
                          </td>
                          @else
                         @endif
                      </tr>
                    </tbody>
          </table>
        </div>
      </div>

        <div class="col-md-6 col-xs-12">
           <h3 class="text-center"><b>MY ATTENDANCE</b></h3>
            <canvas id="myChart" width="800" height="600"></canvas>
        </div>

        <div class="col-md-6">
           <h3 class="text-center"><b>MY ATTENDANCE</b></h3>
            <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">My Attendance Details(Last 7 days).</button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                            <thead>
                             <tr>
                             	<th class="text-center">Date</th>
                             	<th class="text-center">Marked</th>
                             	<th class="text-center">Taken By</th>
                                <th class="text-center">Taken At</th>
                             </tr>
                            </thead> 
                            <tbody class="text-center">
                            	<tr class="success">
                            		<td>02/03/2017</td>
                            		<td>P</td>
                            		<td>Vipin kumar</td>
                                    <td>02/03/2017 10:47:55</td>
                            	</tr>
                            	<tr class="success">
                            		<td>02/03/2017</td>
                            		<td>P</td>
                            		<td>Vipin kumar</td>
                                    <td>02/03/2017 10:47:55</td>
                            	</tr>
                            	<tr class="success">
                            		<td>02/03/2017</td>
                            		<td>P</td>
                            		<td>Vipin kumar</td>
                                    <td>02/03/2017 10:47:55</td>
                            	</tr>
                            	<tr class="danger">
                            		<td>02/03/2017</td>
                            		<td>A</td>
                            		<td>Vipin kumar</td>
                                    <td>02/03/2017 10:47:55</td>
                            	</tr>
                            	<tr class="success">
                            		<td>02/03/2017</td>
                            		<td>P</td>
                            		<td>Vipin kumar</td>
                                    <td>02/03/2017 10:47:55</td>
                            	</tr>
                            	<tr class="danger">
                            		<td>02/03/2017</td>
                            		<td>P</td>
                            		<td>Vipin kumar</td>
                                    <td>02/03/2017 10:47:55</td>
                            	</tr>
                            	<tr class="success">
                            		<td>02/03/2017</td>
                            		<td>P</td>
                            		<td>Vipin kumar</td>
                                    <td>02/03/2017 10:47:55</td>
                            	</tr>
                            </tbody>                 
                        </table>
                     </div>
                    <a class="pull-right" href="/st/student/attendence/{{$user->reg_no}}/details">Details</a>
                </div>
           </div>        
        </div>
      
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
  <script type="text/javascript">
      var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June','July','Agust','September','October','November','December'],
        datasets: [{
            label: 'attendance',
            data: [88,98,94,88,90,90,88,98,94,88,90,90],
            backgroundColor:'#0b0d3e',
            hoverBackgroundColor:'#0b0d3e', 
           
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                   min: 0,
                   max: 100,
                      callback: function(value){return value+ "%"} 
                    },
                    scaleLabel: {
                   display: true
                
                }
               
            }]
        }
    }
});
  </script>
@endsection
