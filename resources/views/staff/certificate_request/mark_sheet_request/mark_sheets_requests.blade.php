@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
         <button class="btn btn-primary btn-block">
         Mark Sheet Requests
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
                <th class="text-center">Ticket No</th>
                <th class="  text-center">Status</th>
                <th class=" text-center">View</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $i = 0 ?>
              @foreach($marksheetrequests as $marksheetrequest)
                <?php $i++ ?>
                <tr>
                    <td>{{  $i }}</td>
                    <td>{{ $marksheetrequest->students['reg_no']}}</td>
                    <td>{{ $marksheetrequest['created_at']->format('d/m/Y') }}</td>
                    <td>{{ $marksheetrequest['ticket_no'] }}</td>
                    <td>
                       @if($marksheetrequest->status == 1)
                         Ready
                        @else
                        Awaiting
                      @endif 
                    </td>
                    <td> 
                    <a class="btn btn-primary btn-xs" href="/staff/student/{{$marksheetrequest['ticket_no']}}/{{$marksheetrequest['id']}}/{{strtotime($marksheetrequest['created_at'])}}/mark_sheet_view">
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
  {{ $marksheetrequests->appends(request()->only(['from','to','course','query']))->links() }}
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