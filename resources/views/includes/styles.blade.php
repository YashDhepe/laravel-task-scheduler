{{-- BEGIN: Bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script> --}}
{{-- END: Bootstrap --}}

{{-- BEGIN: Fonts --}}
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
{{-- END: Fonts --}}

{{-- BEGIN: Sweet Alert --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- END: Sweet Alert --}}

{{-- BEGIN: Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- END: Font Awesome --}}

{{-- BEGIN: Flatpickr --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
{{-- END: Flatpickr --}}

{{-- BEGIN: Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{-- END: Select2 --}}


{{-- BEGIN: Custom styles --}}
<link href="{{ asset('css/main.css') }}" rel="stylesheet" />
{{-- END: Custom styles --}}

@if (!empty($pageConfigs['has_table']))
    @if ($pageConfigs['has_table'])
    @endif
@endif


{{-- BEGIN: Page Styles --}}
@yield('page-style')
{{-- RND: Page Styles --}}
