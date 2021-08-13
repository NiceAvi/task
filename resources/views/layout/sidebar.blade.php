<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('customer.index', []) }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Customers</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('items.index', []) }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Items</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('bills.index', []) }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Bills</span></a>
    </li>



</ul>
