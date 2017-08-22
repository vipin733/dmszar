<div class="panel panel-primary">
                <div class="panel-heading">Image</div>
                <div class="panel-body">

                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Upload Image</a></li>
                    <li><a data-toggle="tab" href="#menu1">Capture Image</a></li>
                  </ul>

                  <div class="tab-content">

                  <div id="home" class="tab-pane fade in active">
                      <div class="col-sm-4 col-sm-offset-4 text-center">
                      <div class="col-sm-8 col-sm-offset-2">
                       <a href="#" class="thumbnail">
                            @if($student->avatar)
                            <img src="{{ $student->avatar }}" class="img-responsive img-rounded" alt="Responsive image">
                          @else
                            <img src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/student_male.png" class="img-responsive img-rounded" alt="Responsive image">
                          @endif
                       </a>
                       </div>
                       <div class="form-group">
                        <input name="avatar_image" id="avatar_image" type="file"/>
                        </div>
                       </div>
                    </div> 
                    
                    <div id="menu1" class="tab-pane fade">
                      <div class="col-sm-6 col-sm-offset-3" id="tttttttt">
                       <div class="text-center">
                         <video id="video" width="350" height="300"></video>
                         <a href="#" id="capture" class="btn-primary btn btn-block">Capture</a>
                       </div>  
                      </div> 

                      <div class="col-sm-4 col-sm-offset-4" id="imgggg" style="display: none;"">
                       <div class="text-center">
                        <canvas id="canvas" width="350" height="300"></canvas>                   
                          <a href="#" class="thumbnail">
                            <img src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/student_male.png" id="photo"  class="img-responsive img-rounded" alt="Responsive image">
                          </a>
                        <input style="display: none;"" name="avatar" id="avatar"  class="form-control" type="text"/>
                        <div class="form-group">
                        <a href="#" id="videobb" class="btn-primary btn btn-block">Reset</a>
                        </div>
                       </div>  
                      </div>
                    </div>

                  </div>

                </div>
            </div>