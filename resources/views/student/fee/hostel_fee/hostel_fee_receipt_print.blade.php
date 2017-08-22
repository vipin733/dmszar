<!DOCTYPE html>
<html>
<head>

<title>Hostel Printing</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/css/font-awesome.min.css')}}">
</head>
<style type="text/css">
  body {
   
    font-family: sans-serif;
}

</style>
<body>
<div class="row"  style="margin-top: 20px;, border: 1px;">
   <div class=" col-xs-12 col-sm-12 col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
         <div class="row">

            <div class="col-md-2 col-xs-2 col-sm-2">
                <div class="text-center">
                   @if($owner->schoolprofile['logo'])
                       <img src="{{ $owner->schoolprofile['logo'] }}" alt="{{$owner->schoolprofile['school_name']}}" width="100" height="100">
                       @else
                       <img src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/no-image-found.jpg" alt="{{$owner->schoolprofile['school_name']}}" width="100" height="100">
                  @endif
                </div>
            </div>

            <div class="col-md-10 col-xs-10 col-sm-10">
                <div class="text-center">
                    <h4><strong>{{$owner->schoolprofile['school_name']}}</strong></h4>
                    <h5>
                      {{ $owner->schoolprofile['school_address'] }}, {{ $owner->schoolprofile['city'] }}, {{ $owner->schoolprofile->appdistricts['name'] }}, {{$owner->schoolprofile->states['name']}}, - {{$owner->schoolprofile['pincode']}}
                    </h5>
                    <h5 style=""><strong>Hostel Fee Receipt({{ $hostelfee->asessions['name'] }})</strong></h5>
                </div>
            </div>

         </div><br>

        <div class="row">
         <div class="col-md-6 col-xs-6 col-sm-6">
          <div class="table-responsive">
          <table class=" table table-bordered  table-hover">
            <thead>
              <tr>
                <th>
                  Date
                </th>
                <td>
                 {{Carbon\Carbon::today()->format('d/m/Y')}}
                </td>
              </tr>
              <tr>
                <th>
                  Receipt No.
                </th>
                <td>
                H/{{$hostelfee->created_at->format('Y')}}/{{ $hostelfee->reciept_no }}
                </td>
              </tr>
              <tr>
                <th>
                  Student ID
                </th>
                <td>
                  {{ $hostelfee->students['reg_no'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Student Name
                </th>
                <td>
                  {{ $hostelfee->students['name'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Father Name
                </th>
                <td>
                  {{ $hostelfee->students['father_name'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Course Name
                </th>
                <td>
                  {{ $hostelfee->courses['name'] }}
                </td>
                </tr>
                <tr>
                  <th>
                 Hostel
                </th>
                <td>
                  {{ $hostelfee->hostels['name'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Fee Submitted Date
                </th>
                <td>
                  {{ $hostelfee['created_at']->format('d/m/Y') }}
                </td>
                </tr>
            </thead>

          </table>
        </div>
        </div>
         <div class="col-md-6 col-xs-6 col-sm-6">
         <div class="table-responsive">
          <table class=" table table-bordered  table-hover">
            <thead>
              <tr>
                <th>
                 <div class="text-center">
                   Fee Type
                 </div>
                </th>
                <th>
                  <div class="text-center">
                   Fee
                  </div>
                </th>
                <th>
                  <div class="text-center">
                   Remarks
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
                  <tr>
                      <td>
                        <div class="text-center">
                          Hostel Fee
                        </div>
                        </td>
                      <td>
                          <div class="text-center">
                              <i class="fa fa-inr" aria-hidden="true"></i> {{ $hostelfee['hostel_fee'] }}
                          </div>
                      </td>
                      <td rowspan="5">
                        <div class="text-center">
                       
                         @if($hostelfee->remarks)
                           {{ $hostelfee['remarks'] }}
                          @else
                          Fee submited
                        @endif
                        
                          </div>
                      </td>
                  </tr>

                 
                  <tr>
                      <td>
                        <div class="text-center">
                          Late Fee
                        </div>
                      </td>
                       <td>
                           <div class="text-center">
                            
                              <i class="fa fa-inr" aria-hidden="true"></i> 
                              @if($hostelfee->late_fee)
                              {{ $hostelfee['late_fee'] }}
                               @else
                               0
                              @endif
                           
                          </div>
                       </td>
                  </tr>

                  <tr>
                      <td>
                        <div class="text-center">
                          Other Fee
                        </div>
                      </td>
                       <td>
                           <div class="text-center">
                            
                              <i class="fa fa-inr" aria-hidden="true"></i> 
                              @if($hostelfee->late_fee)
                              {{ $hostelfee['other_fee'] }}
                               @else
                               0
                              @endif
                           
                          </div>
                       </td>
                  </tr>
                 
                  <tr>
                      <td>
                       <div class="pull-right">
                         <strong>Total</strong>
                        </div>
                      </td>
                       <td>
                          <div class="text-center">
                              <strong><i class="fa fa-inr" aria-hidden="true"></i> {{ $total}}</strong>
                          </div>
                       </td>
                  </tr>

            </tbody>
          </table>
          </div>
         </div>
        </div>

         <div class="row">
          <div class="col-md-8">
            <h5>By: <strong>{{ $hostelfee->takers['name'] }}</strong></h5>
          </div>
       </div>
       
   </div>
  </div>

 </div>
</div>

</body>
</html>