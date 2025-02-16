<!DOCTYPE html>

<head>
    <title>home-reservation</title>

    @include('include.head_link')


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

</head>

<body class="animsition">

    <div class="page-wrapper">

        @include('include.sidebar_admin')


        <br><br>

        <div class="page-container2">

            <!-- STATISTIC-->
            <section class="statistic">
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>Nom </th>
                                <th>Ref </th>
                                <th>Filière</th>
                                <th>Période</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Aller</th>
                                <th>Retour</th>
                            </tr>
                        </thead>
                        @isset($data_ges_reserv)
                        @foreach($data_ges_reserv as $d)
                        @php
                        $id_etud = $d->id_ges_reserv;
                        $data_etud = App\Models\Personne::find($d->id_etudiant);
                        // dd($data_etud);
                        if ($data_etud) {
                        $nom_etud = $data_etud->nom;
                        $filiere = $data_etud->filiere;
                        } else {
                        $nom_etud = "Inconnu";
                        $filiere = "Inconnu";
                        }
                        @endphp
                        <tbody>

                            <tr>
                                <td>{{$nom_etud}}</td>
                                <td>{{$d->reference}}</td>
                                <td>{{$filiere}}</td>
                                <td>{{$d->periode}}</td>
                                <td>{{$d->date_reser}}</td>
                                <td>{{$d->statut}}</td>

                                <td>
                                    <button onclick="window.location.href='/prendre_mat/{{$d->reference}}'" class="item"
                                        data-toggle="tooltip" style="color: #45a049;" data-placement="top"
                                        title="Update">
                                        <i class="zmdi zmdi-plus"></i>
                                    </button>
                                </td>
                                <td>
                                    <button onclick="window.location.href='/delete_reserv/{{$d->reference}}'"
                                        class="item" data-toggle="tooltip" style="color: red;" data-placement="top"
                                        title="delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </td>
                        </tbody>
                        @endforeach
                        @endisset

                    </table>
                </div>
            </section>
            <!-- END STATISTIC-->



            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-8">
                            <!-- RECENT REPORT 2 right-->

                            <!-- END RECENT REPORT 2             -->
                        </div>
                        <div class="col-xl-4">
                            <!-- TASK PROGRESS left-->

                            <!-- END TASK PROGRESS-->
                        </div>
                    </div>
                </div>
            </div>
            </section>

            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6">
                                <!-- USER DATA right-->

                                <!-- END USER DATA-->
                            </div>
                            <div class="col-xl-6">
                                <!-- MAP DATA left-->

                                <!-- END MAP DATA-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2024. All rights reserved. Template by <a href="#">lesam</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END PAGE CONTAINER-->

        </div>
    </div>


    @include('include.foot_link')
</body>

</html>