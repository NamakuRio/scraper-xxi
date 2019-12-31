<!DOCTYPE html>
<html class="loading" lang="id" data-textdirection="ltr">
    <!-- BEGIN: Head-->
    <head>
        @include('templates._partials._head')
        @include('templates._partials._styles')
    </head>
    <!-- END: Head-->
    <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">
        @include('templates._partials._sidebar')
        <!-- BEGIN: Content-->
        <div class="app-content content">
            @include('templates._partials._navbar')
            <div class="content-wrapper">
                <div class="content-header row"></div>
                <div class="content-body">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END: Content-->
        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        @include('templates._partials._footer')
        @include('templates._partials._scripts')
    </body>
    <!-- END: Body-->
</html>
