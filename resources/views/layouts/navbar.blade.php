<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            @if(auth()->user())
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-icon btn-round">
                        <i class="fas fa-bars text-center visible-on-sidebar-mini"></i>
                        <i class="fas fa-ellipsis-v text-center visible-on-sidebar-regular"></i>
                    </button>
                </div>
                <div class="navbar-toggle">
                    <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                </div>
            @endif
            <a class="navbar-brand" href="#pablo">@stack('title')</a>
        </div>
    </div>
</nav>
<!-- End Navbar -->
