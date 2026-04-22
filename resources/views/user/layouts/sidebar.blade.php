@php
    use Illuminate\Support\Facades\Auth;
@endphp

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <a class="nav-link text-info-neon" href="{{url('user')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt text-info"></i></div>
                        STATION_BASE
                    </a>

                    <a class="nav-link" href="{{url('user/order-history')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                        LOG_ARCHIVE
                    </a>
                    <a class="nav-link" href="{{url('user/settings')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-microchip"></i></div>
                        SYSTEM_CORE
                    </a>

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <strong>{{ Auth::check() ? Auth::user()->name : 'Guest' }}</strong>
            </div>

        </nav>
    </div>