<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="@asset('app-assets/vendors/css/vendors.min.css')" />
@yield('css-vendor')
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="@asset('app-assets/css/bootstrap.css')" />
<link rel="stylesheet" type="text/css" href="@asset('app-assets/css/bootstrap-extended.css')" />
<link rel="stylesheet" type="text/css" href="@asset('app-assets/css/colors.css')" />
<link rel="stylesheet" type="text/css" href="@asset('app-assets/css/components.css')" />
<link rel="stylesheet" type="text/css" href="@asset('app-assets/css/themes/dark-layout.css')" />
<link rel="stylesheet" type="text/css" href="@asset('app-assets/css/themes/semi-dark-layout.css')" />
<!-- END: Theme CSS-->

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="@asset('app-assets/css/core/menu/menu-types/vertical-menu.css')" />
<link rel="stylesheet" type="text/css" href="@asset('app-assets/css/core/colors/palette-gradient.css')" />
@yield('css-page')
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="@asset('assets/css/style.css')" />
<!-- END: Custom CSS-->

@yield('css-script')
