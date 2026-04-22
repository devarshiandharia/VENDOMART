<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <a class="nav-link" href="{{url('admin')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div> Manage Category
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{url('admin/add-category')}}">Add Category</a></li>
                            <li><a class="dropdown-item" href="{{url('admin/view-category')}}">View Categories</a></li>
                        </ul>
                    </li>
                    <a class="nav-link" href="{{url('admin/users')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                        Manage Users
                    </a>
                    {{-- <a class="nav-link" href="{{url('admin/vendors')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users-rectangle"></i></div>
                        Manage Vendors
                    </a> --}}
                    <a class="nav-link" href="{{url('admin/orders')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-down-short-wide"></i></div>
                        Manage Orders
                    </a>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-box"></i></div>
                            Manage Products
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{url('admin/add-product')}}">Add</a></li>
                            <li><a class="dropdown-item" href="{{url('admin/view-product')}}">View</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle font-weight-bold" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="sb-nav-link-icon text-info-neon"><i class="fa-solid fa-file-export"></i></div>
                            Export Reports
                        </a>
                        <ul class="dropdown-menu bg-dark border-secondary">
                            <li><a class="dropdown-item text-light" href="{{url('admin/export/orders/excel')}}"><i class="fa-solid fa-file-excel text-success me-2"></i>Orders Excel</a></li>
                            <li><a class="dropdown-item text-light" href="{{url('admin/export/orders/pdf')}}"><i class="fa-solid fa-file-pdf text-danger me-2"></i>Orders PDF</a></li>
                        </ul>
                    </li>


                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Admin
            </div>
        </nav>
    </div>