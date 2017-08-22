<nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/superadmin/home') }}">
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
                            <li>
                              <a href="/superadmin/users"><i class="fa fa-user" aria-hidden="true"></i> Users</a>        
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Blog <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/superadmin/blog/index"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                    </li>
                                     <li>
                                        <a href="/superadmin/blog/create"><i class="fa fa-plus" aria-hidden="true"></i> Create</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                       @include('superadmin.layouts.logout')
                                    </li>
                                </ul>
                            </li>

                    </ul>
                </div>
            </div>
        </nav>