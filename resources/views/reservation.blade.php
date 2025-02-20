<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label,
    input,
    textarea {
        display: block;
        width: 100%;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    input,
    textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        height: 100px;
    }

    .btn-submit {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #45a049;
    }
    </style>

    @include('include.head_link')
</head>

<body class="index-page">

    {{-- <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="">Myiuc</h1>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>{{session('prenom_etud')}}</li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <a class="btn-getstarted" href="/logout">Logout</a>
        </div>
    </header> --}}



    <main class="main">



        <!-- Catégorie Section -->


        <!-- End catégorie Section -->



        <!-- VP Section -->
        <section id="courses" class="courses section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
            </div><!-- End Section Title -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="course-item">
                            <img src="{{session('path_image')}}" class="img-fluid" alt="...">
                            <div class="course-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="price">disponible</p>
                                </div>
                                <h3>{{session('ref_mat')}}</h3>
                            </div>
                        </div>
                    </div> <!-- End Course Item-->

                    <div class="col-lg-4 col-md-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">

                        <body>
                            <div class="container">
                                <h2>Veillez remplir</h2>
                                <form action="/reservation/materiel" method="POST">
                                    {{@csrf_field()}}

                                    <div class="form-group">
                                        <label for="date_reser">Date :</label>
                                        <input type="date" id="date_reser" name="date_reser" required>
                                    </div>


                                    <input type="hidden" name="reference" value="{{session('ref_mat')}}">

                                    <div class="form-group">
                                        <select name="periode">
                                            <option>Période</option>
                                            <option>8h00-09h50</option>
                                            <option>10h10-12h</option>
                                            <option>13h-14h50</option>
                                            <option>15h10-17h</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="commentaires">Commentaires :</label>
                                        <textarea id="commentaires" name="commentaire"></textarea>
                                    </div>

                                    <input type="hidden" name="id_etudiant" value="{{session('id_etud')}}">

                                    <div class="form-group">
                                        <input type="submit" class="btn-submit" value="Enregistrer">
                                    </div>
                                </form>
                            </div>
                        </body>
                    </div> <!-- End Course Item-->
                </div>
            </div>
        </section><!-- /VP Section -->


        <!-- /chimique Section -->

        <!-- /chimique Section -->


    </main>




    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    @include('include.foot_link')

</body>

</html>
