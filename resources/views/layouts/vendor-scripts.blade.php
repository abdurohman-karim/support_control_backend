<!-- JAVASCRIPT -->
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/node-waves/node-waves.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/toastr/toastr.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/pages/toastr.init.js')}}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('/assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>

<!-- App js -->
<script src="{{ URL::asset('assets/js/app.min.js')}}"></script>
<script src="{{ URL::asset('assets/myScripts.js')}}"></script>
@yield('script')
@if(session('_message'))
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        Command: toastr['{{ session('_type') ?? 'info'}}']('{{session('_message')}}', '{{ session('_description') ?? ' ' }}')
    </script>
    @php(message_clear())
@endif
<script>
    function UsdToUzsShow(usdInput, tdElement) {
        // Get the value from the USD input
        var usdValue = parseFloat(usdInput);

        //Check if usdInput is empty set 0 to usdValue
        if (isNaN(usdValue)) {
            usdValue = 0;
        }

        let rate = {{ getRateFloat() }};
        // Calculate UZS equivalent
        var uzsWithRate = usdValue * rate;
        // Set the calculated UZS value to the UZS input
        var uzsInput = addCommas(uzsWithRate.toFixed(0));

        // Create the popover element
        var popoverContent = '<div class="popover" data-bs-toggle="popover" data-bs-trigger="focus">' +
            '<div class="popover-header font-size-14 popover-header text-nowrap">'+uzsInput+'</div></div>';

        // Initialize popover using Bootstrap 5 Popover
        var popover = new bootstrap.Popover(tdElement, {
            content: popoverContent,
            placement: 'top',
            html:true,
            delay: { "show": 0, "hide": 1000 },
            animation: true,
            trigger: 'focus' // Show popover manually
        });

        // Show popover
        popover.show();
        setTimeout(function() {
            popover.hide();
        }, 2000);
    }
    function updateSidebarClass() {
        const sidebarElement = $("#site-body");
        const sidebarValue = getCookie('sidebar');

        if (sidebarValue === "min") {
            sidebarElement.addClass("vertical-collpsed");
        }
    }

    // Call the function on page load to apply the class initially
    $(document).ready(function () {
        updateSidebarClass();
    });
    function switchTheme(){
        $.ajax({
            url: '{!! route('switchTheme') !!}',
            type: "post", //send it through post method
            data: {
                user_id: "{!! auth()->id() !!}"
            },
            success:function (response) {
                if (response === 'light')
                {
                    $("#bootstrap-style").attr('href', '/assets/css/bootstrap.min.css');
                    $("#app-style").attr('href', '/assets/css/app.min.css');
                }else
                {
                    $("#bootstrap-style").attr('href', '/assets/css/bootstrap-dark.min.css');
                    $("#app-style").attr('href', '/assets/css/app-dark.min.css');
                }
                console.log(response);
            },
            error:function(err){
                show(err.message)
            }
        });
    }
    function show(message,timeout=10000) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "showDuration": "60000",
            "hideDuration": "1000",
            "timeOut": timeout,
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr.error(message)
    }
</script>
@foreach($errors->all() as $error)
    <script>
        show("{{ $error }}")
    </script>
@endforeach
@yield('script-bottom')
