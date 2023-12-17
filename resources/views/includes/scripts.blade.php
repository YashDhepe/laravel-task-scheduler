{{-- BEGIN: Common Scripts --}}
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
{{-- END: Common Scripts --}}

{{-- BEGIN: Bootstrap JS and dependencies --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
{{-- END: Bootstrap JS and dependencies --}}

{{-- BEGIN: Sweet Alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
{{-- END: Sweet Alert --}}

{{-- BEGIN: Flatpickr --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
{{-- ENF: Flatpickr --}}

{{-- BEGIN: Select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- ENF: Select2 --}}

{{-- BEGIN: Main Scripts --}}
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
{{-- END: Main Scripts --}}

{{-- BEGIN: Datatable Scripts --}}
@if (!empty($pageConfigs['has_table']))
    @if ($pageConfigs['has_table'])
        @isset($dataTable)
            {!! $dataTable->scripts() !!}
        @endisset
    @endif
@endif
{{-- BEGIN: Datatable Scripts --}}

{{-- BEGIN: Page Styles --}}
@yield('page-script')
{{-- RND: Page Styles --}}
