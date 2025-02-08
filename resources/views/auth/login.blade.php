<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>login page</title>

    <style type="text/css">
        .authlogin-side-wrapper {
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center center;
            width: 100%;
            height: 100%;
            background-image: url({{ asset('upload/login.png') }});

        }
    </style>

	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('backend/assets/vendors/core/core.css')}}">
	<!-- endinject -->
  <!-- plugin css for this page -->
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('backend/assets/fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<!-- endinject -->
  <!-- Layout styles -->
	<link rel="stylesheet" href="{{asset('backend/assets/css/demo_2/style.css')}}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{asset('backend/assets/images/login.png')}}" />
</head>

<style>
    .page-content{
        background-color: grey;

        background-image: url('backend/assets/images/bataillon2.jpg');
        background-size: cover; /* Pour redimensionner l'image pour couvrir l'élément */
        background-repeat: no-repeat; /* Pour éviter la répétition de l'image */


    }
</style>
<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card">
							<div class="row">
                <div class="col-md-4 pr-md-0">
                  <div class="authlogin-side-wrapper">

                  </div>
                </div>
                <div class="col-md-8 pl-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo logo-light d-block mb-2">Gestion de matériel</a>
                    <h5 class="text-muted font-weight-normal mb-4">Bienvenu, Veuillez-vous connecter...</h5>

                    <form class="forms-sample" method="POST" action="{{ route('login') }}">
                        @csrf
                      <div class="form-group">
                        <label for="login">Adresse-mail ou Nom ou Téléphone</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Email">
                      </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" autocomplete="current-password">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                    <i class="fa fa-eye" id="toggle-icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>



                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="checkbox" id="remember_me" class="form-check-input" name="remember">
                          Se souvenir de moi
                        </label>
                      </div>

                      <div class="mt-3">
                        <button type="submit" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                Se connecter
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- core:js -->
	<script src="{{asset('backend/assets/vendors/core/core.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

	<!-- endinject -->
  <!-- plugin js for this page -->
	<!-- end plugin js for this page -->
	<!-- inject:js -->
	<script src="{{asset('backend/assets/vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{asset('backend/assets/js/template.js')}}"></script>
	<!-- endinject -->
  <!-- custom js for this page -->
	<!-- end custom js for this page -->

    {{-- <script>
        $(document).ready(function () {
            $("#toggle-password").click(function () {
                var passwordField = $("#password");
                var passwordFieldType = passwordField.attr("type");

                if (passwordFieldType === "password") {
                    passwordField.attr("type", "text");
                } else {
                    passwordField.attr("type", "password");
                }
            });
        });
    </script> --}}

    <script>
        $(document).ready(function () {
            $("#toggle-password").click(function () {
                var passwordField = $("#password");
                var icon = $("#toggle-icon");

                if (passwordField.attr("type") === "password") {
                    passwordField.attr("type", "text");
                    icon.removeClass("fa-eye");
                    icon.addClass("fa-eye-slash");
                } else {
                    passwordField.attr("type", "password");
                    icon.removeClass("fa-eye-slash");
                    icon.addClass("fa-eye");
                }
            });
        });
    </script>


</body>
</html>
