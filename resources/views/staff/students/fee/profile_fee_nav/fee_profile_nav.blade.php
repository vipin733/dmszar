<div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
      <button class="btn btn-primary btn-block">Student Information</button>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class=" table table-bordered  table-hover">
            <thead>
                <tr>
                  <th class="text-center">Reg. No.</th>
                  <th class="text-center">Student Name</th>
                  <th class="text-center">Father Name</th>
                  <th class="text-center">Course Name</th>
                  @if($user->TransportationTaken())
                  <th class="text-center">Pay Transport Fee</th>
                  @else
                  @endif
                  @if($user->HostelTaken())
                   <th class="text-center">Pay Hostel Fee</th>
                  @else
                  @endif
                  <th class="text-center">Pay Tuition Fee</th>
                  <th class="text-center">Pay Registration Fee</th>
                  <th class="text-center">Attendance</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <td>{{ $user->reg_no}}</td>
                    <td><a href="/st/student/{{$user->reg_no}}">{{ $user->name }}</a></td>
                    <td>{{ $user->father_name }}</td>
                    <td>{{$user->courses['name']}}</td>
                    @if($user->TransportationTaken())
                    <td>
                      <div class="text-center">
                       <a class="btn btn-success" href="/student/{{$user->reg_no}}/{{$user->uuid}}/transport_fee/take"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                    </td>
                    @else
                    @endif
                    @if($user->HostelTaken())
                    <td>
                      <div class="text-center">
                       <a class="btn btn-success" href="/student/{{$user->reg_no}}/{{$user->uuid}}/hostel_fee/take"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                    </td>
                    @else
                    @endif

                    <td>
                      <div class="text-center">
                       <a class="btn btn-success" href="/student/{{$user->reg_no}}/{{$user->uuid}}/tution_fee/take">
                       <i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                    </td>

                    <td>
                      <div class="text-center">
                         <a class="btn btn-success" href="/student/{{$user->reg_no}}/{{$user->uuid}}/registraion_fee/take">
                         <i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                         </a>
                      </div>
                    </td>

                     <td>
                      <div class="text-center">
                       <a class="btn btn-success" href="/st/student/attendence/{{$user->reg_no}}/details"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                    </td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>    
    </div>
  </div>  