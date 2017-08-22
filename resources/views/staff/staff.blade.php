@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center"><b>Staff Dashboard</b></div>

              <div class="panel-body">
                    
                <div class="col-sm-3">
                  <div class="col-sm-12">
                  <a href="#" class="thumbnail">
                     @if(Auth::user()->avatar)
                       <img src="{{ Auth::user()->avatar }}" class="img-responsive img-rounded" alt="{{Auth::user()->name}}">
                    @else
                       <img src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/student_male.png" class="img-responsive img-rounded" alt="{{Auth::user()->name}}">
                    @endif
                  </a>
                  </div>

                  <div class="col-sm-12">
                      <h4 class="text-center">Welcome<br> {{ Auth::user()->name }}!<br>(<b>{{ Auth::user()->reg_no }}</b>)</h4>  
                      <div>
                        <ul class="list-group">
                        <a href="#" class="list-group-item active"> 
                         Basic Staff Info
                         </a>
                        <li class="list-group-item">Session- {{ $asession['name'] }}</li>
                        </ul>
                      </div> 
                  </div>              
                </div>

                <div class="col-sm-9">
                    
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
                                @foreach($events as  $event)
                                     @if ($loop->first)
                                        <div class="item active">
                                        @else
                                        <div class="item">
                                     @endif
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <small>
                                          {{ $event->title }}
                                        </small>

                                        <p class="pull-right"><a href="/staff/events/view">View</a></p>
                                       
                                      </div>
                                    </div>
                                </div>
                                @endforeach
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

