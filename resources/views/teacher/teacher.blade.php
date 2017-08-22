@extends('layouts.app')
@section('nav')
@include('teacher.teacher_nav')
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center"><b>Teacher Dashboard</b></div>

              <div class="panel-body">
                    
                <div class="col-sm-3">
                  <div class="col-sm-12">

                  <a href="#" class="thumbnail">

                   @if(Auth::user()->avatar)
                       <img src="{{ Auth::user()->avatar }}" class="img-responsive img-rounded" alt="{{ Auth::user()->name }}">
                    @else
                       <img src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/student_male.png" class="img-responsive img-rounded" alt="{{ Auth::user()->name }}">
                    @endif
                    
                  </a>
                   
                  </div>

                  <div class="col-sm-12">
                      <h4 class="text-center">Welcome<br> {{ Auth::user()->name }}!<br>(<b>{{ Auth::user()->reg_no }}</b>)</h4>  
                      <div>
                        <ul class="list-group">
                        <a href="#" class="list-group-item active"> 
                         Basic Teacher Info
                         </a>
                         <li class="list-group-item">Session- {{ $asession['name'] }}</li>
                        <li class="list-group-item">Class In-charge- 
                          {{ $user->teacheracadmic->courses['name'] or 'N/A'}}
                        </li>
                        <li class="list-group-item">Section- 
                          {{ $user->teacheracadmic->sections['name'] or 'N/A'}}
                        </li>
                      </div> 
                  </div>              
                </div>

                <div class="col-sm-9">

                  <div class="col-sm-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title text-center">MY TODAY TIME TABLE</h3>
                      </div>
                      <div class="panel-body">
                        <div class="table-responsive text-center">
                          <table class="table table-bordered  table-hover">
                            <thead>
                                <tr class="text-center">
                                  <th class="text-center">Timing</th>
                                  <th class="text-center">S = Subject, C = Class, Se = Section R= Remarks</th>
                                </tr>
                              
                                @foreach($timetables as $timetable)
                                <tr>
                                  <th class="text-center">{{$timetable['start']->format('h:i A')}}-{{$timetable['end']->format('h:i A')}}
                                  </th>
                                  <td>
                                       S-{{ $timetable->$subjectsname['name'] }},
                                       C-{{ $timetable->courses['name'] }},
                                       Se-{{ $timetable->sections['name'] }}<br>
                                       @if($timetable->$remarks)
                                         R-{{ $timetable->$remarks }}
                                       @endif
                                  </td>
                                </tr>
                                @endforeach 
                              
                            </thead>
                          </table>    
                        </div>
                      </div>   
                    </div> 
                  </div>                                     
                  
                    
                    <div class="col-sm-6">
                        <div class="panel panel-warning">
                          <div class="panel-heading">
                            <h3 class="panel-title">Messages</h3>
                          </div>
                          <div class="panel-body">
                            
                             <div class="carousel slide" data-ride="carousel" id="quote-carousel">
          <!-- Bottom Carousel Indicators -->

                                <div class="carousel-inner">
                                  @foreach($user->messages as $message)
                                       @if ($loop->first)
                                          <div class="item active">
                                          @else
                                          <div class="item">
                                       @endif
                                   
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <p>
                                            {{ $message->message }}
                                          </p>
                                          <p class="pull-right">
                                            @if($message->by_teacher_id)
                                             {{ $message->byteacher['name'] }}
                                             @endif
                                             @if($message->by_owner_id)
                                             {{ $message->byowner['name'] }}
                                             @endif
                                          </p>
                                         
                                        </div>
                                      </div>
                                    
                                  </div>
                                  @endforeach
                                </div>

                              </div>
                             </div>

                           </div>

                  </div>
                  
                  <div class="col-sm-6">
                      <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Upcoming Events</h3>
                        </div>
                        <div class="panel-body">
                            <div class="carousel slide" data-ride="carousel" id="quote-carousel">
        <!-- Bottom Carousel Indicators -->

                              <div class="carousel-inner">

                              @if(count($events))
                                @foreach($events as  $event)
                                     @if ($loop->first)
                                        <div class="item active">
                                        @else
                                        <div class="item">
                                     @endif
                           
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <p>{{ $event->title }}</p>
                                       <p class="pull-right"><a href="/teacher/events/view">View</a></p>
                                      </div>
                                    </div>
                               
                                </div>
                                @endforeach
                              @endif  
                              </div>

                            </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-12">
                    <h3 class="text-center"><b>MY ATTENDANCE</b></h3>
                      <canvas id="myChart" width="200" height="100"></canvas>
                  </div>
                    
        </div>  

      

        <div class="col-sm-12">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h3 class="panel-title text-center"><b>Academic Notifications</b></h3>
                      </div>
                      <div class="panel-body">
                       
                        <a href="/notification/index">All Notification</a>
                        <div class="col-sm-12 notification">
                        @foreach($notifications as $notification)
                         <h4><b>{{ $notification->title }}</b></h4>    <p class="pull-right">Posted at <b>{{ $notification->created_at->format('d/m/Y h:i A') }}</b></p> 
                          <p>{{ $notification->notifications_categories['name'] }}
                          </p>
                          {!! $notification->notification_body !!}
                          @endforeach
                        </div>
                        
                      </div>
                    </div>
                </div>

              </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
  
  <script type="text/javascript">
        window.setProgressValue = function(progress) {
          document.querySelector('svg text').innerHTML = progress + '%';
          document.querySelector('circle.progress').style.strokeDashoffset = 100 - progress;
        };

  </script>

  <script type="text/javascript">

  $(document).ready(function() {
  //Set the carousel options
  $('#quote-carousel').carousel({
    pause: true,
    interval: 4000,
  });
});

var month = <?php echo $date; ?>;
var tota = <?php echo $tota; ?>;

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: month,
        datasets: [{
            label: 'attendance',
            data: tota,
            backgroundColor:'#337ab7',
            hoverBackgroundColor:'#337ab7', 
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            xAxes: [{
                ticks: {
                   min: 0,
                   max: 100,
                      callback: function(value){return value+ "%"} 
                    },
                    scaleLabel: {
                   display: true
                
                }
               
            }]
        }
    }
});
  </script>
@endsection

