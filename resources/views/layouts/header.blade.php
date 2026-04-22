@php
  use Illuminate\Support\Facades\Auth;
@endphp
@php
  $isAdmin = Auth::check() && Auth::user()->email === 'admin@gmail.com';
@endphp


<!doctype html>
<html lang="en">

<head>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @stack('title')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

  <style>
    :root {
        --gaming-bg: #050811;
        --gaming-card: #0f172a;
        --neon-cyan: #00f2ff;
        --neon-purple: #bc13fe;
        --neon-pink: #ff00ff;
    }
    
    body {
        background-color: var(--gaming-bg) !important;
        color: #e2e8f0;
        font-family: 'Inter', sans-serif;
    }

    .theme-navbar {
        background: rgba(15, 23, 42, 0.8) !important;
        backdrop-filter: blur(15px);
        border-bottom: 1px solid rgba(0, 242, 255, 0.2);
    }

    .btn-gaming-cyan {
        background: transparent;
        border: 1px solid var(--neon-cyan);
        color: var(--neon-cyan) !important;
        box-shadow: 0 0 10px rgba(0, 242, 255, 0.2);
        transition: all 0.3s;
    }

    .btn-gaming-cyan:hover {
        background: var(--neon-cyan);
        color: #000 !important;
        box-shadow: 0 0 20px var(--neon-cyan);
    }

    .btn-gaming-purple {
        background: transparent;
        border: 1px solid var(--neon-purple);
        color: var(--neon-purple) !important;
        box-shadow: 0 0 10px rgba(188, 19, 254, 0.2);
        transition: all 0.3s;
    }

    .btn-gaming-purple:hover {
        background: var(--neon-purple);
        color: #fff !important;
        box-shadow: 0 0 20px var(--neon-purple);
    }
    
    .nav-search-grp {
        background: rgba(255,255,255,0.05) !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
    }
    
    .nav-search-grp input {
        color: white !important;
        background: transparent !important;
    }
    
    img {
        max-width: 100%;
        height: auto;
    }
  </style>

</head>

<body>
  <nav class="navbar navbar-expand-lg theme-navbar sticky-top shadow-sm">
    <div class="container">
      <a class="navbar-brand py-0" href="{{url('/')}}">
        <h2 style="font-family: 'Orbitron', sans-serif; color: var(--neon-cyan); letter-spacing: 3px; font-weight: 800; margin: 0;">VENDOMART</h2>
      </a>
      <div class="mx-auto d-none d-lg-block">
        <form class="d-flex" role="search" action="{{ url('search') }}" method="GET">
          <div class="input-group nav-search-grp rounded-pill overflow-hidden" style="width:450px;">
            <input class="form-control border-0 ps-4 text-light" type="search" name="query"
              placeholder="Search Cyberware..." aria-label="Search" value="{{ request('query') }}">
            <button class="btn btn-transparent border-0 text-info pe-4" type="submit"><i
                class="fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>
      </div>
      <div>

        @if(!$isAdmin)
          <a href="{{ url('cart-list/cart') }}" class="btn btn-gaming-cyan btn-sm ms-1 rounded-pill px-3 py-2">
            <i class="fa-solid fa-cart-shopping"></i> Inventory
          </a>
        @endif


        @guest
          <a href="{{ route('login') }}" class="btn btn-gaming-purple btn-sm ms-1 rounded-pill px-3 py-2">
            <i class="fa-solid fa-user"></i> Login
          </a>
          <a href="{{ url('admin/login') }}" class="btn btn-gaming-cyan btn-sm ms-1 rounded-pill px-3 py-2">
            <i class="fa-solid fa-id-card-clip"></i> HQ
          </a>
        @endguest

        @auth
          @if($isAdmin)
            <a href="{{ url('admin') }}" class="btn btn-gaming-cyan btn-sm ms-1 rounded-pill px-3 py-2">
              <i class="fa-solid fa-user-shield"></i> Admin Panel
            </a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-2 ms-1">Logout</button>
            </form>
          @else
            <div class="dropdown d-inline ms-1">
              <button class="btn btn-gaming-purple btn-sm rounded-pill px-3 py-2 dropdown-toggle"
                data-bs-toggle="dropdown">
                <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
              </button>
              <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary">
                <li><a class="dropdown-item text-light" href="{{ url('user') }}">Profile</a></li>
                <li><a class="dropdown-item text-light" href="{{ url('user/settings') }}">Settings</a></li>
                <li><hr class="dropdown-divider border-secondary"></li>
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">Disconnect</button>
                  </form>
                </li>
              </ul>
            </div>
          @endif
        @endauth
      </div>
    </div>
  </nav>

  <!-- Category Nav -->

  {{-- <nav class="navbar navbar-expand-lg  shadow p-3 bg-body-tertiary rounded">
    <div class="container">
      ... (Category Nav content) ...
  </nav> --}}