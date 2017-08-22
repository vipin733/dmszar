                       <a href="{{ url('/superadmin/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off" aria-hidden="true"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/superadmin/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>