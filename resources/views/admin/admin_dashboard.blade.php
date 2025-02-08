<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titre')</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('backend/assets/vendors/core/core.css')}}">
    <!-- endinject -->
<!-- endinject -->
<!-- plugin css for this page -->

@section('titre')

Admin

@endsection

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"> --}}
<link rel="stylesheet" href="{{asset('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')}}">


<link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{asset('backend/assets/vendors/moment/moment.min.js')}}">
<link rel="stylesheet" href="{{asset('backend/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')}}">
<!-- end plugin css for this page -->
<!-- inject:css -->
<link rel="stylesheet" href="{{asset('backend/assets/fonts/feather-font/css/iconfont.css')}}">

<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<link rel="stylesheet" href="{{asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
<!-- endinject -->
<!-- Layout styles -->
<link rel="stylesheet" href="{{asset ('backend/assets/css/demo_1/style.css')}}">
<!-- End layout styles -->
<link rel="shortcut icon" type="text/css" href="{{asset('backend/assets/images/dcsic.png')}}" />
<link rel="stylesheet" href="https:://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<link rel="stylesheet" href="{{asset('backend/assets/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
<!-- End plugin css for this page -->
<link rel="stylesheet" href="{{asset('backend/assets/vendors/jquery-steps/jquery.steps.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- <script src="https://cdn.jsdelivr.net/jquery.tagsinput/1.3/jquery.tagsinput.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.tagsinput/1.3/jquery.tagsinput.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script> --}}
<link rel="stylesheet" type="text/css" href="" />
<link rel="stylesheet" href="{{asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css')}}">



    @livewireStyles
</head>

<body class="sidebar-dark" >
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html  <body style="background-color: lightblue;"> -->

        {{--start sidebar--}}
        {{-- @include('admin.body.sidebar') --}}
        {{--end sidebar--}}



        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->

            {{--start navbar--}}
            @include('admin.body.header')


            {{--end navbar--}}

            <!-- partial -->

            {{-- start page-content --}}
            @yield('admin')

            @yield('gestionnaire')

            {{-- end page-content --}}

            <!-- partial:partials/_footer.html -->
            {{--start footer--}}
            @include('admin.body.footer ')

            {{--end footer--}}
            <!-- partial -->

        </div>
    </div>


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


{{-- --------------------------------- --}}
    <!-- core:js -->
    <script src="{{asset('backend/assets/vendors/core/core.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>

    <script src="{{asset('backend/assets/vendors/chartjs/Chart.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/chartjs.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/apexcharts/apexcharts.min.js')}}"></script>


    <script src="{{asset('backend/assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/template.js')}}"></script>
    <script src="{{asset('backend/assets/js/dashboard.js')}}"></script>
    <script src="{{asset('backend/assets/js/datepicker.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/select2.js')}}"></script>
    <script src="{{asset('backend/assets/js/wizard.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/sweetalert/sweetalert.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('backend/assets/js/data-table.js')}} "></script>
    <script src="{{asset('backend/assets/js/dashboard-dark.js')}}"></script>
    {{-- <script src="{{asset('backend/assets/js/code/code.js')}}"></script> --}}
    {{-- <script src="{{asset('backend/assets/js/code/validate.min.js')}}"></script> --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('backend/assets/vendors/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/datatables.net/fr.json')}}"></script>
    <script src="{{asset('backend/assets/vendors/datatables.net/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/datatables.net/buttons.print.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/datatables.net/buttons.html5.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
{{-- ajout --}}
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

    <script>
        // Récupérez le bouton ou le lien
        const refreshButton = document.getElementById('refresh-button'); // Remplacez par l'ID de votre bouton ou lien
        const spinnerContainer = document.querySelector('.loading-spinner-container');

        // Ajoutez un écouteur d'événement pour le clic
        refreshButton.addEventListener('click', () => {
            spinnerContainer.classList.add('visible');

            // Facultatif : Ajoutez un délai pour montrer le spinner avant de rafraîchir la page
            setTimeout(() => {
                window.location.reload(); // Rafraîchissez la page
            }, 1000); // Attendez 1 seconde (1000 ms) avant de rafraîchir
        });
        </script>


@livewireScripts
</body>

</html>
