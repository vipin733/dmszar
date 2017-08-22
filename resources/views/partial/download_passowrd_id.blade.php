<!DOCTYPE html>
<html>
<head>

    <title>Password and Registration</title>

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
   
   <div class="row"  style="margin-top: 20px;, border: 1px;">

     <div class="col-xs-12 col-sm-8 col-md-8 col-md-offset-2 col-sm-offset-2">
          <h1 class="text-center">{{$school}}</h1>
          <h3 class="text-center">{{ $typename }} Password and Registration</h3>
          <div class="panel panel-default">
            <div class="panel-body">

              <div class="table-responsive text-center">
                <table class=" table table-bordered  table-hover">
                 
                  <thead>
                    <tr>
                      <th>{{$typename}} Name</th>
                      <td>{{$name}}</td>
                    </tr>
                    <tr>
                      <th>{{$typename}} Father Name</th>
                      <td>{{$father_name}}</td>
                    </tr>
                    <tr>
                      <th>{{$typename}} Mother Name</th>
                      <td>{{$mother_name}}</td>
                    </tr>
                    <tr>
                      <th>{{$typename}} Registration No.</th>
                      <td>{{$regno}}</td>
                    </tr>
                    <tr>
                      <th>{{$typename}} Password</th>
                      <td>{{$password}}</td>
                    </tr>
                  </thead>

                </table>
              </div>

            </div>
          </div>      
     </div>
     <h4 class="text-center">Please do not share to this any body else who not belongs to this credential</h4>
     <p class="text-center"> Visit www.dmszar.com and use above credential.</p>
   </div>
 

</body>
</html>
