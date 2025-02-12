<nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            <span class="brand-text font-weight-medium"><b>Mail</b>Maker</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ url('/') }}"
                        class="nav-link  {{ $activeMenu == 'home' ? 'active' : '' }} ">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/memo') }}"
                        class="nav-link  {{ $activeMenu == 'memo' ? 'active' : '' }} ">Memo</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="">
                    <a href="{{ url('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ url('logout') }}" method="GET" style="display: none;">
                    </form>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#"> {{ auth()->user()->username }}
                        <i class="fa fa-user ml-1" ></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">User Detail</span>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item">
                            <span class="text-muted text-sm">Username</span>
                            <div class="float-right">
                                {{ auth()->user()->username }}
                                <i class="far fa-user ml-1"></i>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <span class="text-muted text-sm">Name</span>
                            <div class="float-right">
                                {{ auth()->user()->name }}
                                <i class="far fa-address-card ml-1"></i>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <span class="text-muted text-sm">E-mail</span>
                            <div class="float-right">
                                {{ auth()->user()->email }}
                                <i class="far fa-envelope ml-1"></i>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="ddropdown-footer" style="text-align: center"> - </div>
                    </div>
                </li>
            </ul>
        </div>
</nav>

<!-- /.navbar -->
