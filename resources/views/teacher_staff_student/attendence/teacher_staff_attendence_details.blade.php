@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
           <h3 class="text-center"><b>MY ATTENDANCES</b></h3>
            <div class="col-sm-12 text-center" id="sandbox-container">
                <form method="get" id="search-form" class="form-inline" role="form">
                     <div class="input-daterange form-group input-group" id="datepicker">
                        <span class="input-group-addon">From</span>
                        <input type="text" class="input-sm form-control" id="from" name="from">
                        <span class="input-group-addon">to</span>
                        <input type="text" class="input-sm form-control" id="to" name="to">
                     </div>
                     <button type="submit" class="form-control btn btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i> Search</button>
                     <a href="/student/attendence/details" class="btn btn-success">Refresh</a>
                 </form>

            </div><br>

            <div class="col-sm-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                <button class="btn btn-primary btn-block">My Attendance Details</button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                            <thead>
                             <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">Marked</th>
                                <th class="text-center">Entry Time</th>
                                <th class="text-center">Leave Time</th>
                                <th class="text-center">Taken By</th>
                                <th class="text-center">Uploaded At</th>
                             </tr>
                            </thead> 
                            <tbody>

                            @foreach($attendences as $attendence)
                                 @if($attendence->marked == 1)
                                <tr class="success">
                                @else
                                 <tr class="danger">
                                @endif
                                    <td>{{ $attendence['date']->format('d/m/Y') }}</td>
                                    <td>
                                      @if($attendence->marked == 1)
                                       P
                                       @else
                                       A
                                       @endif
                                    </td>
                                    <td>{{$attendence['entry_time']->format('h:i A')}}</td>
                                    <td>{{$attendence['leave_time']->format('h:i A')}}</td>
                                    <td>{{ $attendence->taker['name'] }}</td>
                                    <td>{{$attendence['created_at']->format('d/m/Y h:i A')}}</td>
                                </tr>
                             @endforeach
                                
                            </tbody>                 
                        </table>
                    </div>
                     
                     {{ $attendences->appends(request()->only(['from','to']))->links() }}

                </div>
              </div>   
            </div>
        <button class="btn btn-warning btn-xs btn-block"><b>Disclaimer</b></button>
            <p style="text-align: justify;">This result is issued on the basis of information available in the office of records on the issued date and the Institution reserves the right to update/change any information contained herein without any prior notice. The Institution expressly disclaims all obligations to confirm the accuracy of any of the profile particulars which is based upon the information submitted by the candidate. For any Result/Mapping query, consult to the Institution office.</p>                 
    </div>
    
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
 <script type="text/javascript">

      $(document).ready(function(){
        $('#sandbox-container .input-daterange').datepicker({
    format: "dd/mm/yyyy",
    forceParse: false,
    autoclose: true
});
           $('#search-form').on('submit', function(e) {
               oTable.draw();
               e.preventDefault();
           });
     
})
</script>   

@stop 