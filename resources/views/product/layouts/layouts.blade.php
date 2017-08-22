
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>@yield('title')</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name ="title" content="@yield('title')" />
    <meta name="description" content="@yield('description')"/>
    <meta  content="{{url()->current()}}" property="og:url" />
    <meta name="author" content="@yield('auther')">   
    <meta name="google-site-verification" content="YGII7iPzAzgS54eCT8wGCK3sabgSC3rQczG7IqW0O0s" /> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ mix('css/admin/vector.css') }}">
  
    @yield('css')
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head> 

<body class="home-page">   
    @include('flash::message')
   
    @include('product.layouts.nav')
    
     @yield('content')
    
    @include('product.layouts.footer')
 
    <!-- Javascript -->          
    <script src="{{ mix('js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.min.js"></script>
 <script type="text/javascript" src="/js/back-to-top.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-placeholder/2.3.1/jquery.placeholder.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fitvids/1.2.0/jquery.fitvids.min.js"></script>
    <script type="text/javascript" src="/js/jquery.flexslider-min.js"></script>     
    <script type="text/javascript" src="/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
    <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5958c6af23703b0012dd7f74&product=sticky-share-buttons' async='async'></script>
    <script>
    $('#flash-overlay-modal').modal();
   </script>
    @yield('script')
</body>
</html> 

