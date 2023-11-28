<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Roznamcha')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.layouts.partials.styles')
    @yield('styles')
</head>

<body>
    <!-- preloader area start -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

       @include('backend.layouts.partials.topbar')
       @include('backend.layouts.partials.sidebar')

        <!-- main content area start -->
        <div class="page-wrapper">
            @yield('admin-content')
        </div>
        <!-- main content area end -->
        @include('backend.layouts.partials.footer')
    </div>
    <!-- page container area end -->

    @include('backend.layouts.partials.scripts')
    @yield('scripts')
</body>

</html>
