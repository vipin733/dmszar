@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

<div class="row">

    @include('auth.students.profile.attendence_status_profile')

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <button class="btn btn-primary btn-block">
              Log Requests
            </button>
            </div>
            <div class="panel-body">        
              <div class="table-responsive">
                  <table class=" table table-bordered  table-hover" id="userstable">
                    <thead>
                      <tr>
                      <th class="text-center">Serial No.</th>
                      <th class="text-center">Date</th>
                      <th class="text-center">Ticket No</th>
                      <th class="text-center">Category</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">View</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                     <?php $i = 0 ?>
                       @foreach($logrequests as $logrequest)
                        <?php $i++ ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$logrequest['created_at']->format('d/m/Y')}}</td>
                            <td>{{$logrequest['ticket_no']}}</td>
                            <td>{{ $logrequest->logrequestcategories['name'] }}</td>
                            <td>
                               @if($logrequest->status == 1)
                               Close
                               @else
                               Open
                               @endif
                            </td>
                            <td>@include('auth.students.profile.requests.logequests.log_request_view_modal')
                            </td>
                        </tr>
                      @endforeach   
                    </tbody>
                  </table>
              </div>
            </div>
        </div> 
        {{ $logrequests->links() }}
    </div>

</div>
@endsection
