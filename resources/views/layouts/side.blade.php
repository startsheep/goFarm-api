<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('web.dashboard.index') }}">
            <span class="align-middle">AdminKit</span>
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
                Tools & Components
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-buttons.html">
                    <i class="align-middle" data-feather="square"></i> <span class="align-middle">Buttons</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-forms.html">
                    <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-cards.html">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="ui-typography.html">
                    <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="icons-feather.html">
                    <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
                </a>
            </li>

            <li class="sidebar-header">
                Plugins & Addons
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="charts-chartjs.html">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="maps-google.html">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                <div class="mb-3 text-sm">
                    Are you looking for more components? Check out our premium version.
                </div>
                <div class="d-grid">
                    <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
                </div>
            </div>
        </div>
    </div>
</nav>
