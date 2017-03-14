<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/datatables/jquery.dataTables.js') }}" charset="utf-8"></script>

<script src="{{ asset('/plugins/bs-confirm/bootstrap-confirmation.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}" charset="utf-8"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" charset="utf-8"></script>
<script src="{{ asset('/plugins/iCheck/icheck2.js') }}" charset="utf-8"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
