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
                    <a href="{{ url('/memo') }}" class="nav-link  {{ $activeMenu == 'memo' ? 'active' : '' }} ">Memo</a>
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
                <li class="nav-link">
                    <p style="cursor:pointer">{{ auth()->user()->username }}</p>
                </li>
            </ul>
        </div>
</nav>

<!-- /.navbar -->
