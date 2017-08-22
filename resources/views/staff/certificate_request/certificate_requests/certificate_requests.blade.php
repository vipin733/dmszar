@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
         <button class="btn btn-primary btn-block">
        Certificate Requests
         </button>
        </div>
     <div class="panel-body">

          <div class="text-center col-md-12"  id="sandbox-container">
            <form method="" id="search-form" class="form-inline" role="form">
             <div class="input-daterange form-group input-group" id="datepicker">
                <span class="input-group-addon">From</span>
                <input type="text" class="input-sm form-control" id="created_at" name="created_at">
                <span class="input-group-addon">to</span>
                <input type="text" class="input-sm form-control" id="tution_fee" name="tution_fee">
             </div>

               <div class="form-group">
                  <select  id="course" class="form-control" name="course" >
                        <option value="">---Select Course</option>
                       @foreach($courses as $key=>$value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                  </select>
                </div>
             
            <button type="submit" class="form-control btn btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i> Search</button>
             </form>
            </div>

          <div class="col-md-8 col-md-offset-2">
          <br>
             <form method="get">
              <input name="query" class="form-control" placeholder="Search...">
           </form>
          </div>
          
        

        <div class="table-responsive col-md-10 col-md-offset-1">
      <br>
          <table class=" table table-bordered  table-hover" id="userstable">
            <thead>
              <tr>
                <th class="text-center">Serial No.</th>
                <th class=" text-center">Reg. No.</th>
                <th class=" text-center">Request Date</th>
                <th class=" text-center">Request For</th>
                <th class="text-center">Ticket No</th>
                <th class="  text-center">Status</th>
                <th class="text-center">Fee Status</th>
                <th class=" text-center">View</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $i = 0 ?>
              @foreach($ccrequests as $ccrequest)
                <?php $i++ ?>
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $ccrequest->students['reg_no'] }}</td>
                    <td>{{ $ccrequest['created_at']->format('d/m/Y') }}</td>
                    <td>{{ $ccrequest->certificatecategories['name'] }}</td>
                    <td>{{ $ccrequest['ticket_no'] }}</td>
                    <td>
                      @if($ccrequest->status == 0)
                         Awaiting
                         @else
                        Ready
                      @endif
                    </td>
                    <td>
                      @if($ccrequest->fee_status == 0)
                         Not Paid
                         @else
                          Paid
                      @endif
                    </td>
                    <td> 
                    <a class="btn btn-primary btn-xs" href="/staff/student/certificate/{{$ccrequest['ticket_no'] }}/{{$ccrequest['id']}}/{{strtotime($ccrequest['created_at'])}}/request/view">
                     <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    </td>
                </tr>
              @endforeach  
            </tbody>
          </table>
        </div>
   </div>
 </div>
  {{ $ccrequests->appends(request()->only(['from','to','course','query']))->links() }}
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