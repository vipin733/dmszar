<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">

      <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/') }}">
              {{ config('app.name', 'DMSZar') }}
          </a>
         

          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>

          
      </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
      <ul class="nav navbar-nav">
          &nbsp;
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->

              <li><a href="{{ url('/login') }}">Admin Login</a></li>
              <li><a href="{{ url('/register') }}">Register</a></li>
  

        
        </ul>
      </div>
    </div>
</nav>