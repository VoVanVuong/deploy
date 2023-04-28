<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">

<head>
  @include('Admin.layoutAdmin.header')

</head>
<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] End -->

    <!-- [ Layout wrapper ] Start -->
    <div class="layout-wrapper layout-2">
        <div class="layout-inner">
            @include('Admin.layoutAdmin.menuLeft')
            <!-- [ Layout container ] Start -->
            <div class="layout-container">
               @include('Admin.layoutAdmin.menu')
               @yield('content')
            </div>
            <!-- [ Layout container ] End -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    @include('Admin.layoutAdmin.bottom')
</body>
</html>
