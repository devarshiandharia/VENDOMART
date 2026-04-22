<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    @stack('title')
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{url('dashboard/css/styles.css')}}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        :root {
            --gaming-bg: #050811;
            --gaming-card: #0f172a;
            --neon-cyan: #00f2ff;
            --neon-purple: #bc13fe;
            --glass-bg: rgba(15, 23, 42, 0.9);
        }

        body {
            background-color: var(--gaming-bg) !important;
            color: #e2e8f0;
            font-family: 'Inter', sans-serif;
        }

        .sb-nav-fixed #layoutSidenav #layoutSidenav_nav {
            background-color: var(--gaming-card) !important;
            border-right: 1px solid rgba(0, 242, 255, 0.1);
        }

        .sb-topnav.navbar-dark.bg-dark {
            background: var(--gaming-card) !important;
            border-bottom: 2px solid var(--neon-purple);
        }

        .navbar-brand {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-cyan) !important;
            font-weight: 800;
            letter-spacing: 3px;
        }

        .card {
            background: var(--glass-bg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: 0.3s;
        }

        .card:hover {
            border-color: var(--neon-cyan);
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.1);
        }

        .text-info-neon {
            color: var(--neon-cyan) !important;
            text-shadow: 0 0 10px rgba(0, 242, 255, 0.3);
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 2px;
            color: white;
        }

        .sb-sidenav-dark {
            background-color: var(--gaming-card) !important;
        }

        .sb-sidenav-dark .sb-sidenav-footer {
            background-color: #020617 !important;
            border-top: 1px solid rgba(255,255,255,0.05);
        }
        
        .nav-link {
            color: #94a3b8 !important;
            transition: 0.3s;
        }
        
        .nav-link:hover {
            color: var(--neon-cyan) !important;
            padding-left: 10px;
        }
        
        .sb-nav-link-icon {
            color: var(--neon-cyan) !important;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{url('admin')}}">Vendomart</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-info" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control bg-dark border-secondary text-light" type="text" placeholder="Global system scan..." />
                <button class="btn btn-outline-info" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-info" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user-shield fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item text-light" href="{{url('/')}}" target="_blank">View Live Site</a></li>
                    <li>
                        <hr class="dropdown-divider border-secondary" />
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                TERMINATE_SESSION
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>