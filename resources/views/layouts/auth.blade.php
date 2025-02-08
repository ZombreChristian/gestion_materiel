<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gestion</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 <!-- Font Awesome -->
 <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
   <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
</head>
<body class="hold-transition login-page bg-grey" style="transform: translateY(-80px);">
    <style>
.login-page{
            background-color: grey;

            background-image: url('images/tontine.jpg');
            background-size: cover; /* Pour redimensionner l'image pour couvrir l'élément */
            background-repeat: no-repeat; /* Pour éviter la répétition de l'image */


        }
    </style>
@yield("container")
<!-- /.login-box -->

<!-- REQUIRED SCRIPTS -->
        <script  src="plugins/jquery/jquery.min.js"></script>

        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="dist/js/adminlte.min.js?v=3.2.0"></script>
</body>
</html>
