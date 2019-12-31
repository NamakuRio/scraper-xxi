<!DOCTYPE html>
<html class="loading" lang="id" data-textdirection="ltr">
    <!-- BEGIN: Head-->
    <head>
        @include('templates._partials._head')
        @include('templates._partials._styles')
    </head>
    <!-- END: Head-->
    <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">
        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
        <!-- END: Content-->
        @include('templates._partials._scripts')
    </body>
    <!-- END: Body-->
</html>
