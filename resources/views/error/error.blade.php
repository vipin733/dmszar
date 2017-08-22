<!DOCTYPE html>
<html>
<head>
  <title>404 errors</title>

  <link href="/css/app.css" rel="stylesheet">
  <style type="text/css">
    .error-template {padding: 40px 15px;text-align: center;}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }
  </style>
</head>
<body>
<div class="container">
@include('flash::message')
    <div class="row">
    <div class="error-template">
      <h1 style="font-size: 120px; color: #b74545">Oops!</h1>
      <h2 style="font-size: 100px; color: #b74545;">404 Not Found</h2>
      <div class="error-details" style="font-size: 20px;color: brown;">
        Sorry, looks Like Something Wrong!<br>   
      </div>
      <div class="error-actions">
      <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-primary">
                                            <i class="icon-home icon-white"></i> Take Me login
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
    <a href="sales@dmszar.com" class="btn btn-default">
        <i class="icon-envelope"></i>Contact Support </a>
      </div>
  </div>
    </div>
</div>
</body>
</html>