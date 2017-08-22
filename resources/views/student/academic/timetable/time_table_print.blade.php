<!DOCTYPE html>
<html>
<head>

    <title>{{$studentacadmic->courses['name'].'-'.$studentacadmic->sections['name'].'-time-table-'. $studentacadmic->asessions['name']}}</title>
   <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.min.css')}}">
</head>

<body>

<div class="container">
      <h3 class="text-center">My Time Table {{$studentacadmic->asessions['name']}}</h3>
  <div class="row">
   <div class="panel panel-default">
      <div class="panel-body">

        <div class="col-md-12">
          <div class="table-responsive">
          <table class=" table table-bordered  table-hover">
            <thead>

              <tr>

                <th class="text-center">Registration No</th>              
                <td class="text-center">{{ Auth::user()->reg_no}}</td>

                <th class="text-center">Class</th>              
                <td class="text-center">{{$studentacadmic->courses['name']}}</td>
             
                <th class="text-center">Section</th>              
                <td class="text-center">{{ $studentacadmic->sections['name'] }}</td>

                <th class="text-center">Lunch Break Start</th>              
                <td class="text-center">
                  @if($lunchtime['start'])
                  {{$lunchtime['start']->format('h:i A')}}
                  @else
                  N/A
                  @endif
                </td>
                <th class="text-center">Lunch Break End</th>              
                <td class="text-center">
                  @if($lunchtime['end'])
                  {{$lunchtime['end']->format('h:i A')}}
                  @else
                  N/A
                  @endif
                </td>

              </tr>
            </thead>
          </table>
        </div>
      </div>  

        <div class="col-md-12">
          <table class=" table table-bordered  table-hover">

            <thead>
                <tr>
                  <th colspan="2" class="text-center">Timing</th>
                  <th colspan="7" class="text-center">
                    Day
                    <b class="pull-left">S = Subject, T = Teacher, R = Remarks</b>
                  </th>
                </tr>
                <tr>                                  
                  <th class="text-center">Start</th>
                  <th class="text-center">End</th>                                
                  @foreach($days as $day)
                   <th  class="text-center">{{ $day->name }}</th>
                  @endforeach                          
                </tr>
            </thead>

            <tbody>

            @foreach($timetables as $timetable)
              <tr class="text-center">

                  <td>{{$timetable['start']->format('h:i A')}}</td>
                  <td>{{$timetable['end']->format('h:i A')}}</td>
                  <td>
                     @if( $timetable->sundaysubjects['name'])
                       S-{{ $timetable->sundaysubjects['name'] }}<br>
                     @endif
                     @if( $timetable->sundayteachers['name'])
                       T-{{ $timetable->sundayteachers['name'] }}<br>
                     @endif
                     @if($timetable->sunday_remarks)
                       R-{{ $timetable->sunday_remarks }}
                     @endif
                  </td>
                  <td>
                     @if( $timetable->mondaysubjects['name'] )
                       S-{{ $timetable->mondaysubjects['name'] }}<br>
                     @endif
                     @if( $timetable->mondayteachers['name'])
                       T-{{ $timetable->mondayteachers['name'] }}<br>
                     @endif
                     @if($timetable->monday_remarks)
                       R-{{ $timetable->monday_remarks }}
                     @endif
                  </td>
                  <td>
                     @if( $timetable->tuesdaysubjects['name'] )
                       S-{{ $timetable->tuesdaysubjects['name'] }}<br>
                     @endif
                     @if( $timetable->tuesdayteachers['name'])
                       T-{{ $timetable->tuesdayteachers['name'] }}<br>
                     @endif
                     @if($timetable->tuesday_remarks)
                       R-{{ $timetable->tuesday_remarks }}
                     @endif
                  </td>
                  <td>
                     @if( $timetable->wednesdaysubjects['name'] )
                       S-{{ $timetable->wednesdaysubjects['name'] }}<br>
                     @endif
                     @if( $timetable->wednesdayteachers['name'])
                       T-{{ $timetable->wednesdayteachers['name'] }}<br>
                     @endif
                     @if($timetable->wednesday_remarks)
                       R-{{ $timetable->wednesday_remarks }}
                     @endif
                  </td>
                  <td>
                     @if( $timetable->thursdaysubjects['name'] )
                       S-{{ $timetable->thursdaysubjects['name'] }}<br>
                     @endif
                     @if( $timetable->thursdayteachers['name'])
                       T-{{ $timetable->thursdayteachers['name'] }}<br>
                     @endif
                     @if($timetable->thursday_remarks)
                       R-{{ $timetable->thursday_remarks }}
                     @endif
                  </td>
                  <td>
                     @if( $timetable->fridaysubjects['name'] )
                       S-{{ $timetable->fridaysubjects['name'] }}<br>
                     @endif
                     @if( $timetable->fridayteachers['name'])
                       T-{{ $timetable->fridayteachers['name'] }}<br>
                     @endif
                     @if($timetable->friday_remarks)
                       R-{{ $timetable->friday_remarks }}
                     @endif
                  </td>
                  <td>
                     @if( $timetable->saturdaysubjects['name'] )
                       S-{{ $timetable->saturdaysubjects['name'] }}<br>
                     @endif
                     @if( $timetable->saturdayteachers['name'])
                       T-{{ $timetable->saturdayteachers['name'] }}<br>
                     @endif
                     @if($timetable->saturday_remarks)
                       R-{{ $timetable->saturday_remarks }}
                     @endif
                  </td> 
                </tr>
              @endforeach

            </tbody>

          </table>
        </div>

      </div>  
    </div>          
  </div>
</div>
      
</body>
</html>
