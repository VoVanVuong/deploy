<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">
    <div class="app-brand demo">
        <span class="app-brand-logo demo">
            <img src="{{ URL::to('assetsAdmin/img/logo.png') }}" alt="Brand Logo" class="img-fluid">
        </span>
        <a href="{{ route('admin-dashboard') }}"
            class="app-brand-text demo sidenav-text font-weight-normal ml-2">Empire</a>
        <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
            <i class="ion ion-md-menu align-middle"></i>
        </a>
    </div>
    <div class="sidenav-divider mt-0"></div>

    <ul class="sidenav-inner py-1">

        <li class="sidenav-item active">
            <a href="{{ route('admin-dashboard') }}" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Dashboards</div>
                <div class="pl-1 ml-auto">
                    <div class="badge badge-danger">Hot</div>
                </div>
            </a>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">Người dùng</li>
        <li class="sidenav-item">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon lnr lnr-users"></i>
                <div>Người dùng</div>
            </a>
            <ul class="sidenav-menu">
                <li class="sidenav-item">
                    <a href="{{ route('admin-add-user') }}" class="sidenav-link">
                        <div>Thêm người dùng</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="{{ route('user-management') }}" class="sidenav-link">
                        <div>Quản lí nhân viên </div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="{{ route('user-lecturers') }}" class="sidenav-link">
                        <div>Quản lí giảng viên </div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">Forms & Tables</li>
        <li class="sidenav-item">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon feather icon-clipboard"></i>
                <div>Forms</div>
            </a>
            <ul class="sidenav-menu">
                <li class="sidenav-item">
                    <a href="forms_layouts.html" class="sidenav-link">
                        <div>Layouts and elements</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="forms_input-groups.html" class="sidenav-link">
                        <div>Input groups</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidenav-item">
            <a href="tables_bootstrap.html" class="sidenav-link">
                <i class="sidenav-icon feather icon-grid"></i>
                <div>Tables</div>
            </a>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">Icons</li>
        <li class="sidenav-item">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon feather icon-feather"></i>
                <div>Icons</div>
            </a>
            <ul class="sidenav-menu">
                <li class="sidenav-item">
                    <a href="icons_feather.html" class="sidenav-link">
                        <div>Feather</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="icons_linearicons.html" class="sidenav-link">
                        <div>Linearicons</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">Pages</li>
        <li class="sidenav-item">
            <a href="pages_authentication_login-v1.html" class="sidenav-link">
                <i class="sidenav-icon feather icon-lock"></i>
                <div>Login</div>
            </a>
        </li>
        <li class="sidenav-item">
            <a href="pages_authentication_register-v1.html" class="sidenav-link">
                <i class="sidenav-icon feather icon-user"></i>
                <div>Signup</div>
            </a>
        </li>
        <li class="sidenav-item">
            <a href="pages_faq.html" class="sidenav-link">
                <i class="sidenav-icon feather icon-anchor"></i>
                <div>FAQ</div>
            </a>
        </li>
    </ul>
</div>
