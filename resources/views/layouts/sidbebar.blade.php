<div class="sidebar" data-color="white" data-active-color="primary">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="logo">
        <a href="{{ route('home') }}" class="simple-text logo-mini">
            {{ config('app.name') }}
        </a>
        <a href="{{ route('home') }}" class="simple-text logo-normal">
            <img src="{{ asset('img/logo.svg') }}">
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <i class="far fa-user-circle"></i>
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#userCollapse" class="collapsed">
                    <span>
                        {{ auth()->user()->name }}
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="userCollapse">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('reset_password_form') }}">
                                <i class="fas fa-key"></i>
                                <span class="sidebar-normal">Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off"></i>
                                <span class="sidebar-normal">Log Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="{{ active_route('home') }}">
                <a href="{{ route('home') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="{{ active_route('hotel_types') }}">
                <a href="{{ route('hotel_types') }}">
                    <i class="fas fa-concierge-bell"></i>
                    <p>Hotel Types</p>
                </a>
            </li>
            <li class="{{ active_route('hotels') }}">
                <a href="{{ route('hotels') }}">
                    <i class="fas fa-hotel"></i>
                    <p>Hotels</p>
                </a>
            </li>
        </ul>
    </div>
</div>
