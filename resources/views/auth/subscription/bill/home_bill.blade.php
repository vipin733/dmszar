@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

@if($invoice_latest)

    <div class="row">
     <br><br><br>
        <div class="col-md-10 col-md-offset-1">
         <h1>!Welcome {{Auth::user()->name}}</h1><p>to the DMSZar Account Billing console. Your last month, month-to-date, and month-end costs appear below.<br>
         Current month-to-date balance for {{$invoice_latest->created_at->format('F, Y')}}.</p>
         <h1 class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> {{10 * $invoice_latest->no_student}}</h1>
        </div> 
    </div>
    
    <div class="row">    
        <br><br><br>
        <div class="col-md-6">
         <canvas id="Chart" height="400" width="600"></canvas>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <button class="btn btn-primary btn-block">My Bill Details({{$invoice_latest->created_at->format('F, Y')}})</button>
                </div>
                <div class="panel-body text-center">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                               <tr>
				                    <th colspan="1" class="text-center">No of Students</th>
                                    <td colspan="3" class="text-center">{{$invoice_latest->no_student}}</td>
                                </tr>
                                <tr> 
                                    <th colspan="1" class="text-center">No of Staffs</th>
                                    <td colspan="3" class="text-center">{{$invoice_latest->no_staff}}</td>
                                </tr>
                                <tr> 
	                                <th colspan="1" class="text-center">No of Teachers</th>
	                                <td colspan="3" class="text-center">{{$invoice_latest->no_teacher}}</td>
				                </tr>
				                <tr> 
	                                <th colspan="1" class="text-center">Total bill</th>
	                                <td colspan="3" class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> {{10 * $invoice_latest->no_student}}</td>
				                </tr>
                           </thead>
                         </table>
                    </div>
                    <a class=" btn btn-primary" href="/auth/bill/details">Last Bill Details</a>
                </div>
            </div>               
        </div>

 </div>
 <br><br>
  @else
 <H1  class="text-center" >No Bill Found</H1>

 @endif
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>

<script type="text/javascript">
   
  var paymentamount = <?php echo $paymentamount; ?>;
  var due_month = <?php echo $due_month; ?>;
    

var ctx = document.getElementById("Chart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: due_month,
        datasets: [{
            label:'Bill',
            data: paymentamount,
            backgroundColor:'#004b91',
            hoverBackgroundColor:'#004b91', 
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

</script>
@stop