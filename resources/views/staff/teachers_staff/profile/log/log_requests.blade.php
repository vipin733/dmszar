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
         Complain Requests
         </button>
        </div>
        <div class="panel-body">
          <div class="text-center"  id="sandbox-container">
            <form method="get" id="search-form" class="form-inline" role="form">

              <div class="input-daterange form-group input-group" id="datepicker">
                <span class="input-group-addon">From</span>
                <input type="text" class="input-sm form-control" id="from" name="from">
                <span class="input-group-addon">to</span>
                <input type="text" class="input-sm form-control" id="to" name="to">
              </div>

              <div class="form-group">
                <select  id="session" class="form-control" name="session" >
                      <option value="">---Select Session</option>
                     @foreach($asessions as $key=>$value)
                      <option value="{{ $key }}">{{ $value }}</option>
                      @endforeach
                </select>
              </div>

              <div class="form-group">
                <select  id="category" class="form-control" name="category" >
                      <option value="">---Select Category</option>
                     @foreach($logrequestcategories as $key=>$value)
                      <option value="{{ $key }}">{{ $value }}</option>
                      @endforeach
                </select>
              </div>

              <button type="submit" class="form-control btn btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i> Search</button>
              <a class="btn btn-warning" href="/teacher_staff/{{$teacher->reg_no}}/log_request">Refresh</a>
          
            </form>
          </div>

        <div class="table-responsive col-md-12">
      <br>
          <table class=" table table-bordered  table-hover" id="userstable">
            <thead>
              <tr>
                <th class=" text-center">Serial No.</th>
                <th class=" text-center">Date</th>
                <th class=" text-center">Session</th>
                <th class=" text-center">Ticket No</th>
                <th class=" text-center">Category</th>
                <th class=" text-center">Status</th>
                <th class=" text-center">View</th>
              </tr>
            </thead>
            <tbody class="text-center">
               <?php $i = 0 ?>
               @foreach($logrequests as $logrequest)
                <?php $i++ ?>
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{$logrequest['created_at']->format('d/m/Y')}}</td>
                    <td>{{ $logrequest->asessions['name'] }}</td>
                    <td>{{$logrequest['ticket_no']}}</td>
                    <td>{{ $logrequest->logrequestcategories['name'] }}</td>
                    <td>
                       @if($logrequest->status == 1)
                       Close
                       @else
                       Open
                       @endif
                    </td>
                    <td> 
                      <a class="btn btn-primary btn-xs" href="/staff/teacher_students/logs/{{$logrequest['ticket_no']}}/{{$logrequest['id']}}/{{strtotime($logrequest['created_at'])}}/view">
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
   {{ $logrequests->appends(request()->only(['from','to','session','query']))->links() }}
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