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
                                <td>{{ $attendence->taker['name'] }}</td>
                                    <td>{{$attendence['created_at']->format('d/m/Y h:i A')}}</td>
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