<!-- ******FOOTER****** --> 
    <footer class="footer">
        <div class="footer-content">
            <div class="container">
                <div class="row">                    
                    <div class="footer-col links col-md-2 col-sm-4 col-xs-12">
                        <div class="footer-col-inner">
                            <h3 class="title">About us</h3>
                            <ul class="list-unstyled">
                                <li><a href="/about"><i class="fa fa-caret-right"></i>About us</a></li>
                                <li><a href="/contact"><i class="fa fa-caret-right"></i>Contact us</a></li>
                            </ul>
                        </div><!--//footer-col-inner-->
                    </div><!--//foooter-col-->               
                    <div class="footer-col links col-md-2 col-sm-4 col-xs-12 sm-break">
                        <div class="footer-col-inner">
                            <h3 class="title">Support</h3>
                            <ul class="list-unstyled">
                                <li><a href="#"><i class="fa fa-caret-right"></i>Support</a></li>
                                <li><a href="/privacy_policy"><i class="fa fa-caret-right"></i>Privacy Policy</a></li>
                                <li><a href="/terms_conditions"><i class="fa fa-caret-right"></i>Terms of Use</a></li>
                            </ul>
                        </div><!--//footer-col-inner-->            
                    </div><!--//foooter-col-->
                    <div class="footer-col links col-md-2 col-sm-4 col-xs-12 sm-break">
                        <div class="footer-col-inner">
                            <h3 class="title">Contact us</h3>                          
                            <p class="adr clearfix">
                                <i class="fa fa-map-marker pull-left"></i>        
                                <span class="adr-group pull-left">       
                                    <span class="street-address">#262, 2nd Floor, Kavirampur</span><br>
                                    <span class="region">State Highway 98</span><br>
                                    <span class="postal-code">Baragaon</span><br>
                                    <span class="country-name">Uttar Pradesh, India 221204</span>
                                </span>
                            </p>
                            <p class="tel"><i class="fa fa-phone"></i>+917696446317</p>
                            <p class="email"><i class="fa fa-envelope-o"></i><a href="#">sales@dmszar.com</a></p> 
                            <a href="https://twitter.com/dms_zar" class="twitter-follow-button" data-show-count="false">Follow @dms_zar</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>                        
                        </div>
                    </div>   
                    <div class="footer-col connect col-xs-12 col-md-6 text-center">
                        <div class="footer-col-inner">
                            <ul class="social list-inline">
                                <li><a href="https://twitter.com/dms_zar" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://facebook.com/dmszar"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://plus.google.com/u/3/116633480415746153994"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>        
             
                            </ul>
                            <div class="form-container">
                                <p class="intro">Stay up to date with the latest news and offers from DMSZar</p>
                                @include('partial.errors')
                                <form class="signup-form navbar-form" method="post" action="/subscription/email" data-parsley-validate ="">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="email"  name="email" class="form-control" placeholder="Enter your email address" required="">
                                    </div>   
                                    <button type="submit" class="btn btn-cta btn-cta-primary">Subscribe Now</button>
                                </form>  
                                @include('flash::message')                             
                            </div><!--//subscription-form-->
                        </div><!--//footer-col-inner-->
                    </div><!--//foooter-col-->
                    <div class="clearfix"></div> 
                </div><!--//row-->
            </div><!--//container-->
        </div><!--//footer-content-->
        <div class="bottom-bar">
            <div class="container">
                <small class="copyright">Copyright @ <a href="/" target="_blank">DMSZar InfoTech LLP</a></small>                
            </div><!--//container-->
        </div><!--//bottom-bar-->
    </footer><!--//footer-->