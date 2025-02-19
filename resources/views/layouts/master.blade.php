<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion</title>

    @livewireStyles
    {{-- <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet" /> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" > --}}
    <link rel="stylesheet"  href="{{asset('plugins/toastr/toastr.min.css')}}" >
    <link rel="stylesheet"  href="{{asset('plugins/toastr/toastr.css')}}" >

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.css"> --}}


    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css?v=3.2.0')}}">

    <link rel="stylesheet" href="{{asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">
{{--  --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/dropzone/min/dropzone.min.css')}}">

{{--  --}}


</head>


<body class="hold-transition sidebar-mini">

        <div class="wrapper">

       <x-topnav />


        <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="index3.html" class="brand-link">
            <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Logo</span>
        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{userFullName()}}</a>
                </div>
            </div>


           <x-menu />
        </div>

        </aside>

        <div class="content-wrapper">



        <div class="content">
            <div class="container-fluid">
                @yield("contenu")
            </div>
        </div>

        </div>


       <x-sidebar />



        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>

            <strong>Copyright &copy; 2022-2023 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
        </div>


        {{-- <script src="https://cdn.jsdelivr.net/npm/jquery.steps@1.1.1/dist/jquery-steps.min.js"></script> --}}
{{--
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script> --}}


    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    {{-- <script src="plugins/jquery/jquery.min.js"></script> --}}

    <script src="{{asset('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('dist/js/adminlte.min.js?v=3.2.0')}}"></script>


    {{-- <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js" ></script> --}}

    {{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>

    {{-- <script src="{{asset('')}}"></script> --}}
    <script src="{{asset('plugins/sweetalert2/dist/sweetalert2.all.js')}}"></script>
    {{-- <script src="{{asset('plugins/sweetalert2/dist/sweetalert2.min.css')}}"></script> --}}


    <script src="{{asset('plugins/code/code.js')}}"></script>
    {{-- <script src="{{asset('plugins/code/validate.min.js')}}"></script> --}}

    {{-- <script src="{{asset('dist/js/wizard.js')}}"></script> --}}
    <script src="{{asset('plugins/jquery-steps/jquery.steps.min.js')}}"></script>


    {{--  --}}

    {{-- <script src="{{asset('plugins/jquery/jquery.min.js')}} "></script> --}}
{{--
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>

<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

<script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>

<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>


<script src="{{asset('plugins/dropzone/min/dropzone.min.js')}}"></script>

<script src="{{asset('dist/js/adminlte.min.js?v=3.2.0')}}"></script>

<script src="{{asset('backend/assets/js/wizard.js')}}"></script> --}}


    {{-- <script src="../../dist/js/demo.js"></script> --}}

        {{--  --}}



        <script>

            @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
            @endif
            </script>


        @livewireScripts
</body>
</html>
