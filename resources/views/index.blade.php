<!DOCTYPE html>
<html lang="en">

<head>

    @include('include.head_link')


</head>

<body class="index-page">

    @include('include.header')

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <img src="assets/img/uo.jpeg" alt="" data-aos="fade-in">

            <div class="container">
                <h2 data-aos="fade-up" data-aos-delay="100" class="" style="color: white;">Connectez-vous,<br>Et reservé
                    du matériels
                    </h2>

                <p data-aos="fade-up" data-aos-delay="200">Seul les délégués et vice délégues des salles de classe sont
                    autorisés à reserver du matériel</p>
                <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{route ('signup')}}" class="btn-get-started">Commencer</a>
                </div>
            </div>

        </section><!-- /Hero Section -->



    </main>

    @include('include.footer')


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    @include('include.foot_link')

</body>

</html>
