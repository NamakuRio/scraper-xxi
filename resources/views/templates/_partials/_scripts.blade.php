<!-- BEGIN: Vendor JS-->
<script src="@asset('app-assets/vendors/js/vendors.min.js')"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="@asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')"></script>
@yield('js-vendor')
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="@asset('app-assets/js/core/app-menu.js')"></script>
<script src="@asset('app-assets/js/core/app.js')"></script>
<script src="@asset('app-assets/js/scripts/components.js')"></script>
@yield('js-theme')
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
@yield('js-page')
<!-- END: Page JS-->

<script>
    var url = "{{ url('/') }}";
    async function notification(icon, title, position = "top-end", showConfirmButton = false, timer = 3000, timerProgressBar = true)
    {
        const Toast = Swal.mixin({
            toast: true,
            position: position,
            showConfirmButton: showConfirmButton,
            timer: timer,
            timerProgressBar: timerProgressBar,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: icon,
            title: title
        });
    }

    async function swalNotification(status, message)
    {
        swal(message, {
            icon: status,
        });
    }

    var timeOut = null;

    async function alert(location, status, message, time = 0)
    {
        var alerts = $(location).html(`
        <div class="alert alert-`+status+` mb-2" role="alert">
            `+message+`
        </div>
        `);

        if(time != 0){
            clearTimeout(timeOut);
            timeOut = setTimeout(() => {
                alerts.empty();
            }, time);

        }

    }
</script>
@yield('js-script')
