@extends('product.layouts.layouts')
@section('title')
Contact us
@stop
@section('content')
        
        <div class="headline-bg contact-headline-bg">
        </div><!--//headline-bg-->

        
        <!-- ******Contact Section****** --> 
        <section class="contact-section section section-on-bg">
            <div class="container">
                <h2 class="title text-center">Contact Us</h2>
                <p class="intro text-center">We'd love to hear and solve every genuine query from your side. Feel free to ask at any point of time.</p>
                <form id="contact-form" class="contact-form" method="post" action="/contact/post" data-parsley-validate ="">     
                {{ csrf_field() }}               
                    <div class="row text-center">
                        <div class="contact-form-inner col-md-offset-2 col-sm-offset-0 xs-offset-0 col-xs-12 col-md-8">
                            <div class="row">                                                           
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label class="sr-only" for="name">Your name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your name" minlength="2" value="{{ old('name') }}" required="">
                                </div>                    
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label class="sr-only" for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your email address" value="{{ old('email') }}" required="">
                                </div>
                                <div class="form-group col-xs-12">
                                    <label class="sr-only" for="message">Your message</label>
                                    <textarea class="form-control" id="message" name="message" placeholder="Enter your message" rows="12" required="">{{ old('message') }}</textarea>
                                </div>
                                <div class="col-xs-12 form-group">
                                    <div class="text-center {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        {!! Recaptcha::render() !!}<br>
                                         @if ($errors->has('g-recaptcha-response'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-cta btn-cta-primary">Send Message</button>
                                    </div> 
                                </div>                          
                            </div><!--//row-->
                        </div>
                    </div><!--//row-->
                    <div id="form-messages">
                        
                    </div>
                </form><!--//contact-form-->
            </div><!--//container-->
        </section><!--//contact-section-->
        
        <!-- ******Other Contact Section****** --> 
        <section class="contact-other-section section">
            <div class="container text-center">
                <h2 class="title">Other ways to reach us</h2>
                <p class="intro">You can also get in touch with DMSzar through other platforms like e-Mail, Phone, Twitter and Facebook. You may easily reach to us directly at our office address mentioned below. </p>
                <div class="row">
                    <ul class="other-info list-unstyled col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1 xs-offset-0" >
                        <li><i class="fa fa-envelope-o"></i><a href="#">sales@dmszar.com</a></li>
                        <li><i class="fa fa-twitter"></i><a href="https://twitter.com/dms_zar" target="_blank">@dms_zar</a></li>
                        <li><i class="fa fa-phone"></i><a href="tel:+917696446317">+917696446317</a></li>
                        <li><i class="fa fa-map-marker"></i>#262, 2nd Floor, Kavirampur <br /> State Highway 98<br />Baragaon<br />Uttar Pradesh, India 221204<br /></li>
                    </ul>
                </div><!--//row-->
            </div><!--//container-->
        </section><!--//contact-other-section-->
        
        <!-- ******Map Section****** --> 
        <section class="map-section section">
            <div class="container text-center">
                <h2 class="title">How to find us</h2>
                <p class="intro">This is nothing hard to find us if you can use Google map at a single finger tap. Just tap below in the Google map link and get our exact location. You will also find easy commute to reach us.</p>
                <div class="gmap-wrapper">
                    <div class="gmap-wrapper" id="map">
                        <!--//You need to embed your own google map below-->
                        <!--//Ref: https://support.google.com/maps/answer/144361?co=GENIE.Platform%3DDesktop&hl=en -->
                        <iframe src="" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div><!--//gmap-wrapper-->
                </div><!--//gmap-wrapper-->
            </div><!--//container-->
        </section><!--//map-section-->
        
        <!-- ******CTA Section****** -->
        <section id="cta-section" class="section cta-section text-center contact-cta-section">
            <div class="container">
               <h2 class="title">Ready to promote your institute online?</h2>
               <p><a class="btn btn-cta btn-cta-primary" href="/register">Get DMSZar Now</a></p>
            </div><!--//container-->
        </section><!--//cta-section-->

    </div><!--//wrapper-->
    
 @stop 

 