@extends('product.layouts.layouts')
@section('title')
Pricing
@stop
@section('content')
    
    <div class="headline-bg pricing-headline-bg">
    </div><!--//headline-bg-->
    
    <!-- ******Pricing Section****** -->
    <section class="pricing section section-on-bg">
        <div class="container">
            <h2 class="title text-center">**30 days <span class="highlight">FREE</span> trial for all plans**</h2>
            <p class="intro text-center">Our pricing is simple and you can cancel or change your plan at any time.</p>
             <div class="price-cols row">
                <div class="items-wrapper col-md-10 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
                    <div class="item price-1 col-md-4 col-sm-4 col-xs-12 text-center">
                        <div class="item-inner">
                            <div class="heading">
                                <h3 class="title">Basic</h3>
                                <p class="price-figure"><span class="price-figure-inner"><span class="currency"><i class="fa fa-inr" aria-hidden="true"></i></span><span class="number">5</span><br /><span class="unit"> per student</span></span><br /><span class="unit"> per month</span></span></p>
                            </div>
                            <div class="content">
                                <ul class="list-unstyled feature-list">
                                    <li><i class="fa fa-check"></i>Unlimited Student</li>
                                    <li><i class="fa fa-times"></i>Unlimited SMS</li>
                                    <li><i class="fa fa-times"></i>Biometric Attendance</li>
                                    <li class=""><i class="fa fa-check"></i>Email support</li>
                                    <li class=""><i class="fa fa-times"></i>Phone support</li>
                                </ul>
                                <a class="btn btn-cta btn-cta-primary" href="/register">Start free trial</a>
   
                            </div><!--//content-->
                        </div><!--//item-inner-->
                    </div><!--//item--> 
                    
                    <div class="item price-2 col-md-4 col-sm-4 col-xs-12 text-center best-buy">
                        <div class="item-inner">
                            <div class="heading">
                            <h3 class="title">Professional</h3>
                                <p class="price-figure"><span class="price-figure-inner"><span class="currency"><i class="fa fa-inr" aria-hidden="true"></i></span><span class="number">10</span><br /><span class="unit">per student</span></span><br /><span class="unit">per month</span></span></p>
                            </div>
                            <div class="content">
                                <ul class="list-unstyled feature-list">
                                    <li><i class="fa fa-check"></i>Unlimited Student</li>
                                    <li><i class="fa fa-check"></i>Unlimited SMS</li>
                                    <li><i class="fa fa-check"></i>Biometric Attendance*</li>                                   
                                    <li><i class="fa fa-check"></i>Email support</li>
                                    <li><i class="fa fa-check"></i>Phone support</li>
                                </ul>
                                <a class="btn btn-cta btn-cta-primary" href="/register">Start free trial</a>
                            </div><!--//content-->
                            <div class="ribbon">
                                <div class="text">Popular</div>
                            </div><!--//ribbon-->
                        </div><!--//item-inner-->
                    </div><!--//item-->  
                    
                    <div class="item price-3 col-md-4 col-sm-4 col-xs-12 text-center">
                        <div class="item-inner">
                            <div class="heading">
                                <h3 class="title">Enterprise</h3>
                            </div>
                            <div class="content">
                                <ul class="list-unstyled feature-list">
                                    <li><i class="fa fa-check"></i>Dedicated website</li>
                                    <li><i class="fa fa-check"></i>Dedicated database</li>
                                    <li><i class="fa fa-check"></i>Dedicated team</li>
                                    <li><i class="fa fa-check"></i>Biometric Attendance*</li>
                                    <li><i class="fa fa-check"></i>Phone/Email priority support</li>
                                    <li><i class="fa fa-check"></i>Free update</li>
                                    <li><i class="fa fa-check"></i>Unlimited SMS</li>
                                    <li><i class="fa fa-check"></i>24/7 support</li>
                                </ul>
                                <a class="btn btn-cta btn-cta-primary" href="/contact">Request for quote</a>
                                
                            </div><!--//content-->
                        </div><!--//item-inner-->
                    </div><!--//item-->  
                </div><!--//items-wrapper-->                   
            </div><!--//row-->
          
        </div><!--//container-->
    </section><!--//pricing-->

     <!-- ******Steps Section****** --> 
    <div class="row has-bg-color">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-cta btn-cta-primary btn-block">All Plan include</button>
                </div>
                <div class="panel-body">
                  
                    <ul class="list-unstyled feature-list">
                            <li><i class="fa fa-star"></i> New features every month</li>
                            <li><i class="fa fa-star"></i> No software install</li>
                            <li><i class="fa fa-star"></i> No setup cost</li>
                            <li><i class="fa fa-star"></i> No maintenance cost</li>
                            <li><i class="fa fa-star"></i> No contracts</li>
                            <li><i class="fa fa-star"></i> No IT skill required</li>
                            <li><i class="fa fa-star"></i> Free Upgrade</li>
                            <li><i class="fa fa-star"></i> Secure data protection</li>
                            <li><i class="fa fa-star"></i> Access anytime, anywhere</li>
                            <li><i class="fa fa-star"></i> Responsive mobile design</li>
                            <li><i class="fa fa-star"></i> Secure data protection</li>
                            <li><i class="fa fa-star"></i> Automatic backups</li>
                    </ul>
                    <small>**For enterprise case, if you won't opt for further service after trial, you will be still charged for the domain.<br>
                    *For Biometric Attendance you have to Buy Machine.<br>
                    As per Government norms, 18% tax will be charged exclusive of the charge of the service</small> 
                </div>
            </div> 
        </div>
    </div>  
    
    <!-- ******FAQ Section****** --> 
    <section class="faq section has-bg-color">
        <div class="container">
            <h2 class="title text-center">Frequently Asked Questions</h2>
            <div class="row">
                <div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
                     
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq1"><i class="fa fa-plus-square"></i>Why DMSZar? </a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq1">
                            <div class="panel-body">
                                Because only we emphasize on the actual need of the clients and work as per demand.
                            </div>
                        </div>
                    </div><!--//panel-->

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq2"><i class="fa fa-plus-square"></i>Can I start for free?</a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq2">
                            <div class="panel-body">
                                Yes absolutely. When you create your account you start on the free plan. No credit card details are required.<br>
                            </div>
                        </div>
                    </div><!--//panel-->

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq3"><i class="fa fa-plus-square"></i>Does the size of institute matters?</a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq3">
                            <div class="panel-body">
                                No, not at all.
                            </div>
                        </div>
                    </div><!--//panel-->

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq4"><i class="fa fa-plus-square"></i>What is about Data security?</a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq4">
                            <div class="panel-body">
                                Don't think about your data security issues, it is completely our responsibility to secure. It is as secure as your money in your bank account. You need not to worry.
                            </div>
                        </div>
                    </div><!--//panel-->

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq5"><i class="fa fa-plus-square"></i>What if data is lost?</a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq5">
                            <div class="panel-body">
                                No data is lost. We are backing it up through cloud services. You can retrieve it at any time.
                            </div>
                        </div>
                    </div><!--//panel-->

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq6"><i class="fa fa-plus-square"></i>Is there any support services?</a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq6">
                            <div class="panel-body">
                               Yes, off course. We will support you through email, phone call, chat services, etc. You can reach us at any time you need.
                            </div>
                        </div>
                    </div><!--//panel-->

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq7"><i class="fa fa-plus-square"></i>What if additional features are required?</a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq7">
                            <div class="panel-body">
                               That's not an issue of serious concern. The product can be easily customized.
                            </div>
                        </div>
                    </div><!--//panel-->

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq8"><i class="fa fa-plus-square"></i>Can you provide other services related to this field when required?</a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq8">
                            <div class="panel-body">
                               Yeah, why not? Feel free to contact at any time. We will surely sort out your problems with our best effort. 
                            </div>
                        </div>
                    </div><!--//panel-->


                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq9"><i class="fa fa-plus-square"></i>What are the hidden charges?</a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq9">
                            <div class="panel-body">
                                That's tricky but sorry, we don't have any hidden charges. We are very open and clear to our clients.
                            </div>
                        </div>
                    </div><!--//panel-->
            
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq10"><i class="fa fa-plus-square"></i>How do I subscription?</a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq10">
                            <div class="panel-body">
                                It’s easy! After sign-up, go to the Manage >Subscription page and choose a more powerful plan.
                            </div>
                        </div>
                    </div><!--//panel-->
            
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq11"><i class="fa fa-plus-square"></i>What are your plan periods?</a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq11">
                            <div class="panel-body">
                               All plans are billed monthly from the day you upgrade to one of our paid plans. For instance, if you upgrade to a paid plan on 15th March your account will be charged on the 15th of each month.
                            </div>
                        </div>
                    </div><!--//panel-->
                    
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq12"><i class="fa fa-plus-square"></i>Can I downgrade or cancel my plan?</a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq12">
                            <div class="panel-body">
                                Yes! Downgrading is easy. Just make sure your account is within the allowed limits of the lower plan. Your account will be credited with balance of the remaining days in the billing month. Please note you cannot downgrade plans or addons for 15 days after adjusting your subscription.<br>
 
                                It will be a shame to see you leave but you can cancel your subscription at any point. Just contact support and we will process your request..
                            </div>
                        </div>
                    </div><!--//panel--> 

                      <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion"
                            data-toggle="collapse" class="panel-toggle" href="#faq13"><i class="fa fa-plus-square"></i>What if I want to subscribe the service outside India?</a></h4>
                        </div>
            
                        <div class="panel-collapse collapse" id="faq13">
                            <div class="panel-body">
                                 Sure, our service will be there. But only enterprise package will be available now.
                            </div>
                        </div>
                    </div><!--//panel--> 
                                          
                </div>
            </div><!--//row-->
            <div class="contact-lead text-center">
                <h4 class="title">Have more questions?</h4>
                <a class="btn btn-cta btn-cta-secondary" href="/contact">Get in touch</a>
            </div>
        </div><!--//container-->        
    </section><!--//faq-->
    
    <!-- ******CTA Section****** -->
    <section id="cta-section" class="section cta-section text-center pricing-cta-section">
        <div class="container">
           <p class="intro">What are you waiting for?</p>
           <p><a class="btn btn-cta btn-cta-primary" href="/register" target="_blank">Get DMSZar Now</a></p>
        </div><!--//container-->
    </section><!--//cta-section-->
    
@stop