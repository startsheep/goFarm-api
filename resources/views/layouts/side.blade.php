<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('web.dashboard.index') }}">
            <span class="align-middle">Go Farm</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('web.dashboard.index') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                Users
            </li>

            <li class="sidebar-item {{ Request::segment(2) == 'admin' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Admin</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::segment(2) == 'doctor' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('doctor.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Doctor</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::segment(2) == 'merchant' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('merchant.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Merchant</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::segment(2) == 'customer' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('customer.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Customer</span>
                </a>
            </li>

            <li class="sidebar-header">
                Master Data
            </li>

            <li class="sidebar-item {{ Request::segment(1) == 'category' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('category.index') }}">
                    <i class="align-middle" data-feather="flag"></i> <span class="align-middle">Category</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::segment(1) == 'product' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('product.index') }}">
                    <i class="align-middle" data-feather="package"></i> <span class="align-middle">Product</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('') }}">
                    <i class="align-middle" data-feather="shopping-cart"></i> <span
                        class="align-middle">Transaction</span>
                </a>
            </li>

            <li class="sidebar-header">
                Others
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="charts-chartjs.html">
                    <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Merchant
                        Approval</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="maps-google.html">
                    <i class="align-middle" data-feather="message-square"></i> <span
                        class="align-middle">Messages</span>
                </a>
            </li>
        </ul>

    </div>
</nav>
