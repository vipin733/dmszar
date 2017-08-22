@extends('product.layouts.layouts')
@section('title')
DMSZar -Welcome to Digital Area
@stop
@section('content')

 <div class="bg-slider-wrapper">
        <div class="flexslider bg-slider">
            <ul class="slides">
                
            </ul>
        </div>
    </div><!--//bg-slider-wrapper-->        
    
    <section class="promo section section-on-bg">
        <div class="container text-center">                
            <h2 class="title">Next Gen. Cloud Based ERP System For Your Institution</h2>
            <p class="intro">DMSZar is the best place for robust ERP System & Web Development for school & college management</p>
            <p><a class="btn btn-cta btn-cta-primary" href="/register">Try DMSZar Free</a></p>    
        </div><!--//container-->
    </section><!--//promo-->
    
    <div class="sections-wrapper">   
     
        <!-- ******Why Section****** -->
        <section id="why" class="section why">
            <div class="container">
                <h2 class="title text-center">How Can DMSZar Help You?</h2>
                <p class="intro text-center">We only intend to help out all the students, guardian and institute management there to ease the working system</p>
                <div class="row item">
                    <div class="content col-xs-12 col-md-4">
                        <h3 class="title">Cashless Transaction</h3>
                        <div class="desc">
                            <p>The submission of fees in the institute office is the foremost task for the guardians which sometimes create issue for them. Similarly, the institute management has to take very special attention for the collection of the fees.</p>
                            <p>DMSZar has been developed keeping this point at the top priority, where we can provide a very safe gateway for transactions.</p>
                        </div>
                                             
                    </div><!--//content-->
                    <figure class="figure col-md-offset-1 col-sm-offset-0 col-xs-offset-0 col-xs-12 col-md-7">
                        <img class="img-responsive" src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/figure-1.jpg" alt="" />
                    </figure>
                </div><!--//item-->
                
                <div class="row item">
                    <div class="content col-md-push-8 col-sm-push-0 col-xs-push-0 col-xs-12 col-md-4">
                        <h3 class="title">Works across all devices</h3>
                        <div class="desc">
                            <p>Some systems are such that they are limit to work on every platform. This limitation sometime slows down the working.</p>
                            <p>DMSZar System is developed such that it will work on every platform irrespective of system configuration. It will efficiently perform on computer systems, tablets and mobile phones.</p>
                        </div>                       
                    </div><!--//content-->
                    <figure class="figure col-md-pull-4 col-sm-pull-0 col-xs-pull-0 col-xs-12 col-md-7">
                        <img class="img-responsive" src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/responsive.png" alt="" />
                    </figure>
                </div><!--//item-->

                <div class="row item">
                    <div class="content col-xs-12 col-md-4">
                        <h3 class="title">Save your time and effort</h3>
                        <div class="desc">
                            <p>It takes a lot of time and effort in storing and managing the student records like profile, attendance, performance, fee records and other things as well as the all teachers and staffs.</p>
                            <p>DMSZar will help you to store and access each and every records at few tap only saving your time and effort.</p>
                        </div>                       
                    </div><!--//content-->
                    <figure class="figure col-md-offset-1 col-sm-offset-0 col-xs-offset-0 col-xs-12 col-md-7">
                        <img class="img-responsive" src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/figure-2.PNG" alt="" />
                    </figure>
                </div><!--//item-->


                <div class="row item last-item">
                    <div class="content col-md-push-8 col-sm-push-0 col-xs-push-0 col-xs-12 col-md-4">
                        <h3 class="title">Secure data and money</h3>
                        <div class="desc">
                            <p>Sometimes, securing the data and money becomes a real complication for the management. Here, the data are digitized then stored to secure cloud services.</p>
                            <p>All information are kept very safely and with full responsibility. The transactions are made through secure gateways.</p>      
                        </div>
                        
                    </div><!--//content-->
                    <figure class="figure col-md-pull-4 col-sm-pull-0 col-xs-pull-0 col-xs-12 col-md-7">
                        <img class="img-responsive" src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/figure-4.PNG" alt="" />
                    </figure>
                </div><!--//item-->
                                              
                
                <div class="feature-lead text-center">
                    <h4 class="title">Want to discover all the features?</h4>
                    <p><a class="btn btn-cta btn-cta-secondary" href="/features">Take a Tour</a></p>
                </div>
            </div><!--//container-->
        </section><!--//why-->  
        
        <!-- ******Testimonials Section****** -->
        <section class="section testimonials">
            <div class="container">
                <h2 class="title text-center">What are people saying about DMSZar?</h2>
                <div id="testimonials-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#testimonials-carousel" data-slide-to="0" class="active"></li>
                        {{-- <li data-target="#testimonials-carousel" data-slide-to="1"></li>
                        <li data-target="#testimonials-carousel" data-slide-to="2"></li> --}}
                    </ol><!--//carousel-indicators-->
                    <div class="carousel-inner">
                        <div class="item active">
                            <figure class="profile"><img src="{{-- http://themes.3rdwavemedia.com/velocity/1.6/assets/images/people/profile-m-1.png --}}" alt="" /></figure>
                            <div class="content">
                                <blockquote>
                                <i class="fa fa-quote-left"></i>
                                <p>The work of DMSZar team is not less than those who are expert in the field in the metro cities. The best part of DMSZar is the pricing, since they charge exactly what we use.</p>
                                </blockquote>
                                <p class="source">Mr. Rajiv Singh<br /><span class="title">Director, M.B. Public School, Bhaluani, Deoria, U.P.</span></p>
                            </div><!--//content-->                         
                        </div><!--//item-->                        
                                                                
                    </div><!--//carousel-inner-->
                    
                </div><!--//carousel-->
            </div><!--//container-->
        </section><!--//testimonials-->          
        
        
        <!-- ******CTA Section****** -->
        <section id="cta-section" class="section cta-section text-center home-cta-section">
            <div class="container">
               <h2 class="title">Ready to promote your institute online?</h2>
               <p><a class="btn btn-cta btn-cta-primary" href="/register" target="">Get DMSZar Now</a></p>
            </div><!--//container-->
        </section><!--//cta-section-->
        
    </div><!--//section-wrapper-->

@stop    