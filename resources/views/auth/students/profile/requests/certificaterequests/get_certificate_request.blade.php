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
              Certificate Requests
            </button>
            </div>
            <div class="panel-body">        
              <div class="table-responsive">
                  <table class=" table table-bordered  table-hover" id="userstable">
                    <thead>
                      <tr>
                       <th class="text-center">Serial No.</th>
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
                            <a class="btn btn-primary btn-xs" href="">
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
        {{ $ccrequests->links() }}
    </div>

</div>
@endsection
