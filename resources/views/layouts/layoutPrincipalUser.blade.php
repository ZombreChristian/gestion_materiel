<!DOCTYPE html>
<html lang="fr">

<head>
    <title>@yield('title', 'Accueil Utilisateur')</title>
    @include('include.head_link')
</head>

<body class="animsition">
    <div class="page-wrapper">

        @include('include.sidebar_admin')

        <div class="page-container2">
            @yield('content') {{-- Ici sera inséré le contenu des autres pages --}}
        </div>

    </div>

    @include('include.foot_link')
</body>

</html>
