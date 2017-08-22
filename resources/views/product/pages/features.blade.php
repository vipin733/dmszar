@extends('product.layouts.layouts')
@section('title')
Features of DMSZar
@stop
@section('content')
    
    <div class="headline-bg">
    </div><!--//headline-bg-->         
    
    <!-- ******Video Section****** --> 
    <section class="features-video section section-on-bg">
        <div class="container text-center">          
            <h2 class="title">Take a quick tour to features</h2> 
        </div><!--//container-->
    </section><!--//feature-video-->
    
    <!-- ******Features Section****** -->       
    <section class="features-tabbed section">
        <div class="container">
            <h2 class="title text-center">DMSZar Features</h2>
            <div class="row">
                <div class=" text-center col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs text-center" role="tablist">
                        <li class="active"><a href="#feature-1" role="tab" data-toggle="tab"><i class="fa fa-graduation-cap"></i><br /><span class="hidden-sm hidden-xs">Patents/Student</span></a></li>
                        <li><a href="#feature-2" role="tab" data-toggle="tab"><i class="fa fa-user"></i><br /><span class="hidden-sm hidden-xs">Teacher</span></a></li>
                        <li><a href="#feature-3" role="tab" data-toggle="tab"><i class="fa fa-user-secret"></i><br /><span class="hidden-sm hidden-xs">Admin</span></a></li>
                        <li class="last"><a href="#feature-4" role="tab" data-toggle="tab"><i class="fa fa-users"></i><br /><span class="hidden-sm hidden-xs">Principal/Director</span></a></li>
                    </ul><!--//nav-tabs-->
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="feature-1">
                            <h3 class="title sr-only">Patents/Student</h3>                                    
                            <figure class="figure text-center">
                                <img class="img-responsive" src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/student_new.jpg" alt="" />
                            </figure>
                            <div class="desc text-left">
                                <p>For the guardians, submitting the fees and knowing the complete status regarding fees, attendance, progress report, school events and other things of their wards is very important to run the system smoothly. But the conventional methods to achieve these tasks prove not that much efficient.
                                So, DMSZar has developed a robust system to achieve the above mentioned key tasks and to ease the functioning of the institute efficiently. 
                                </p>
                                <p>The key features from Parent & Student aspect are:</p>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-star"></i>Online Fee Payment through NEFT, RTGS, BHIM, Paytm, etc. and related functions</li>
                                    <li><i class="fa fa-star"></i>Can apply for fee extension & refunds (in special case)</li>
                                    <li><i class="fa fa-star"></i>Can see school messages & notifications and track school events</li>
                                    <li><i class="fa fa-star"></i>Can apply for mark sheets & relevant certificates</li>
                                    <li><i class="fa fa-star"></i>Can see attendance details & related analysis</li>
                                    <li><i class="fa fa-star"></i>Can see course profile, time table & exam schedules</li>
                                    <li><i class="fa fa-star"></i>Can see test & exam marks/grades</li>
                                    <li><i class="fa fa-star"></i>Can submit suggestions & complaints</li>
                                    <li><i class="fa fa-star"></i>More....</li>
                                </ul>
                            </div><!--//desc-->
                        </div><!--//tab-pane-->
                        <div class="tab-pane" id="feature-2">
                            <h3 class="title sr-only">Teacher</h3>                                    
                            <figure class="figure text-center">
                                <img class="img-responsive" src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/teacher_new.jpg" alt="" />
                            </figure>
                            <div class="desc text-left">
                                <p>
                                  Teacher plays the most eminent role and work as a bridge between the student’s guardians and the institution. Apart from teaching, they have to maintain a lot of record of the students like attendance, performance reports, leaves update and more.
                                </p>
                                <p>
                                  The system developed by DMSZar reduces the work effort and increases the efficiency considerably.
                                </p>
                                <p>The key features from Teacher aspect are:</p>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-star"></i>Upload student’s attendance online</li>
                                    <li><i class="fa fa-star"></i>Upload students test marks</li>
                                    <li><i class="fa fa-star"></i>Can see school messages & notifications and track school events</li>
                                    <li><i class="fa fa-star"></i>Can apply for leaves and approve student leaves</li>
                                    <li><i class="fa fa-star"></i>Send messages to students & parents</li>
                                    <li><i class="fa fa-star"></i>Can see their time-table for classes(coming soon)</li>
                                    <li><i class="fa fa-star"></i>Can see their attendance & analysis</li>
                                    <li><i class="fa fa-star"></i>Can submit suggestions & complaints</li>
                                    <li><i class="fa fa-star"></i>More....</li>
                                </ul>                               
                            </div><!--//desc-->
                        </div><!--//tab-pane-->
                        <div class="tab-pane" id="feature-3">
                            <h3 class="title sr-only">Admin</h3>
                            <figure class="figure text-center">
                                <img class="img-responsive" src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/staff_new.jpg" alt="" />
                            </figure>
                            <div class="desc text-left">
                                <p>It is the Admin who really administrate the functioning of the institute who’s working gears up the overall progress of the institute. The Admin has to maintain the records of students, teachers and all the other staffs.</p>
                                
                                <p>To facilitate their working, this system of DMSZar will really help them to enhance their performance with less effort.</p>

                                <p>The key features from Admin aspect are:</p>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-star"></i>Can register students, teachers & faculties</li>
                                    <li><i class="fa fa-star"></i>Can make & maintain fee structure</li>
                                    <li><i class="fa fa-star"></i>Can assign class, subject, section & class-teachers</li>
                                    <li><i class="fa fa-star"></i>Can generate time table(coming soon)</li>
                                    <li><i class="fa fa-star"></i>Can generate exam schedule & seating plan(coming soon)</li>
                                    <li><i class="fa fa-star"></i>Can send messages to students & faculties</li>
                                    <li><i class="fa fa-star"></i>Can update students/teachers record like profiles, fees, attendance, etc.</li>
                                    <li><i class="fa fa-star"></i>Analysis of fee collection</li>
                                    <li><i class="fa fa-star"></i>Can confirm online fee payments</li>
                                    <li><i class="fa fa-star"></i>Can see & respond to suggestions & complaints</li>
                                    <li><i class="fa fa-star"></i>More....</li>
                                </ul>
                            </div><!--//desc-->                                    
                        </div><!--//tab-pane-->
                        <div class="tab-pane" id="feature-4">
                            <h3 class="title sr-only">Principal/Director</h3> 
                            <figure class="figure text-center">
                                <img class="img-responsive" src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/screenshot-4.jpg" alt="" />
                            </figure>
                            <div class="desc text-left">
                                <p>
                                 After all, the fore-most admin has to manage and take care of everyone from students to parents, from teachers to clerks and each and every staff. And this is not easy for them to be in touch of everyone manually.
                                </p>
                                <p>The DMSZar System will help these super-admin to know the current status of everyone. They will have access to administrate and update each profiles of their institute.</p>
                                <p>The key features from Super-Admin aspect are:</p>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-star"></i>Can register students, teachers, admin & every staff</li>
                                    <li><i class="fa fa-star"></i>Can make & maintain fee structure</li>
                                    <li><i class="fa fa-star"></i>Can view status of each profiles</li>
                                    <li><i class="fa fa-star"></i>Analysis of fee collection</li>
                                    <li><i class="fa fa-star"></i>Can confirm online fee payments</li>
                                    <li><i class="fa fa-star"></i>Can create new school events</li>
                                    <li><i class="fa fa-star"></i>Can approve leaves of staff</li>
                                    <li><i class="fa fa-star"></i>Can send messages to students, teachers & staff</li>
                                    <li><i class="fa fa-star"></i>Can see & respond to suggestions & complaints</li>
                                    <li><i class="fa fa-star"></i>More....</li>
                                </ul> 
                            </div><!--//desc-->
                        </div><!--//tab-pane-->
                    </div><!--//tab-content-->
                </div><!--//col-md-x-->
            </div><!--//row-->
        </div><!--//container-->
    </section><!--//features-tabbed-->

          
    <!-- ******Steps Section****** --> 
    <section class="steps section">
        <div class="container">
            <h2 class="title text-center">3 Simple Steps to Get you started with DMSZar</h2>
                <div class="row">
                    <div class="step text-center col-xs-12 col-sm-4">
                     <h3 class="title"><span class="number">1</span><br /><span class="text">Choose Plan</span></h3>
                     <p>Choose the most suitable plan for your institute. Feel free to contact us to get help in choosing the appropriate plan.</p>
                    </div><!--//step-->
                    <div class="step text-center col-xs-12 col-sm-4">
                      <h3 class="title"><span class="number">2</span><br /><span class="text">Sign Up</span></h3>
                      <p>Register using your email ID and choose a strong password. Get verification link to your e-mail ID to valid the registration.</p>
                    </div><!--//step-->
                    <div class="step text-center col-xs-12 col-sm-4">
                        <h3 class="title"><span class="number">3</span><br /><span class="text">Start the service</span></h3>
                        <p>This is all you have to do at your side. Now, we will contact you to start the service as soon as possible.</p>
                    </div><!--//step-->
                </div><!--//row-->            
            <div class="text-center"><a class="btn btn-cta btn-cta-primary" href="/register">Get Started!</a></div>
        </div><!--//container-->        
    </section><!--//steps-->

@stop    

