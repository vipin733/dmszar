<!DOCTYPE html>
<html>
<head>

<title>Printing</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('/css/font-awesome.min.css')}}">
</head>
<style type="text/css">
  body {
   
    font-family: sans-serif;
}

</style>
<body>
   
    <div class="col-md-12">
                       
        	<div class="col-sm-4">
        	 	<img src=" {{ url("image/logo.png") }} " class="img-responsive">
        	</div>

        	<div class="col-sm-8 text-right">
        	 	<h3><b>DMSZar Service Invoice</b></h3>
        	 	<h4 class="Invoice_style_border"><b>Service Invoice Summary</b></h4>
        	 	<h4 class="Invoice_style_border">Invoice Date: {{ $invoice->created_at->format('F d, Y') }}
        	 	</h4>
        	 	<h4 class="Invoice_style_border">Invoice Number: {{ $invoice->created_at->format('Y').'-'.$invoice->invoice_no }}
        	 	</h4>
        	 	<h4 class="Invoice_style_border">Total Amount: <i class="fa fa-inr" aria-hidden="true"></i> {{ $invoice->payment_amount }}
        	 	</h4>
        	</div>

            <div class="row">
                <div class="col-sm-6">
                	<h3>Account number: <b>{{Auth::id()}}</b></h3>
                    <h2></h2>
                    <h4><b>Issued To:</b></h4>
                    <address>
                    	{{ $user->name }},<br>
                    	{{ $user->schoolprofile['school_address'] }},<br>
                    	{{ $user->schoolprofile->appdistricts['name'] }},{{ $user->schoolprofile->states['name'] }},<br>
                    	{{ $user->schoolprofile['pincode'] }}, IN 
                    </address>
                </div>    
            </div>

            <div class="row">

                <div class="col-sm-12">
                    <h3>
                        <b>This invoice is for the billing {{ $invoice->month->format('F, Y')}}</b>
                    </h3>
                    <h5>
                    	Greetings from DMSZar, we’re writing to provide you with a Service Invoice for your use of DMSZar service. These charges have been applied to statement summary. Additional information regarding your bill, service charge details, and your account history are available by accessing your Billing Management Console.
                    </h5>
                </div> 

                <div class="col-sm-12">
                   <h1 class="text-center">Invoice summary</h1>
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                               <tr>
				                    <th colspan="1" class="text-center">No of Students</th>
                                    <td colspan="3" class="text-center">{{$invoice_detail->no_student}}</td>
                                </tr>
                                <tr> 
                                    <th colspan="1" class="text-center">No of Staffs</th>
                                    <td colspan="3" class="text-center">{{$invoice_detail->no_staff}}</td>
                                </tr>
                                <tr> 
	                                <th colspan="1" class="text-center">No of Teachers</th>
	                                <td colspan="3" class="text-center">{{$invoice_detail->no_teacher}}</td>
				                </tr>
				                <tr> 
	                                <th colspan="1" class="text-center">Total bill</th>
	                                <td colspan="3" class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> {{ $invoice->payment_amount }}</td>
				                </tr>
                           </thead>
                        </table>
                    </div>
                </div>

            </div>
                <div>
                	<h4>Note:</h4>
                	<ul>
                		<li>
                    		If you have any issue in the invoice, please do contact us at <b>support@dmszar.com</b> or call us at <b>+91-7696446317</b> immediately.
                		</li>
                		<li>
                    		Once the invoice generated, please pay the due bill amount within next 10 days, your account may be deactivated.
                		</li>
                	</ul>
                </div>
                <address class="text-center">
		        	Dmszar infotech LLC,<br>
					Dmszar infotech LLC, #262, 2nd Floor, Kavirampur, State Highway 98,<br>
					Baragaon, Varanasi, UP, 221204<br>
					PAN No: AAJCA9880A<br>
					support@dmszar.com<br>
					All services invoiced herein are Business Support Services sold by DMSZAR infotech LLC, unless otherwise
		        </address>
        </div>

    </div>

</body>
</html>