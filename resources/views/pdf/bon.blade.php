<style>
    .card {
        background-color: transparent;
        border: 1px solid rgba(0, 0, 0, 0.125); /* Bordure de la carte */
        border-radius: 0.3rem; /* Coins arrondis de la carte */
        box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.2); /* Ombre de la carte */
        border: 2px solid #808080;
    }
    .card-header {
        font-weight: bold;
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    .card-body{

    }

    </style>

@extends('gestionnaire.gestionnaire_dashboard')



@section('gestionnaire')
<script>
    $(document).ready(function() {
    var armeCounter = 0; // Compteur pour les champs d'armes

    $('#add-arme').click(function() {
        // Incrémentez le compteur
        armeCounter++;

        // Créez un identifiant unique pour le nouvel élément div
        var divId = 'armeDiv' + armeCounter;

        // Créer un élément div pour chaque arme
        var armeDiv = $('<div class="row" id="' + divId + '"></div>');

        // Sélecteur pour le nom de l'arme
        var nomArmeSelect = $('<div class="form-group col-sm-6"><label for="exampleInputEmail1">Nom Arme</label><select name="armes[]" > @foreach($armes as $arme)<option value="{{ $arme->id }}">{{ $arme->nom }}</option>@endforeach</select></div>');

        // Champ de quantité
        var quantiteInput = $('<div class="form-group col-sm-4"><label for="exampleInputEmail1">Quantité</label><input type="number" name="quantitearme[]" class="form-control"></div>');

        // Bouton de suppression avec confirmation
        var removeButton = $('<div class="form-group col-sm-2 d-flex align-items-end"><button type="button" class="remove-arme btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></div>');

        // Ajouter les sélecteurs, le champ de quantité et le bouton à l'élément div
        armeDiv.append(nomArmeSelect, quantiteInput, removeButton);

        // Ajouter l'élément div au conteneur "armes"
        $('#armes').append(armeDiv);
    });

    $('#armes').on('click', '.remove-arme', function() {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette arme ?")) {
            // Obtenir l'ID de l'élément div parent
            var parentDivId = $(this).closest('div.row').attr('id');
            // Supprimer l'élément div
            $('#' + parentDivId).remove();
        }
    });
});
</script>
<script>
    $(document).ready(function() {
        $('#add-munition').click(function() {
            // Créer un élément div pour chaque arme
            var munitionDiv = $('<div class="row"></div>');

            // Sélecteur pour le nom de l'arme
            var nomMunitionSelect = $('<div class="form-group col-sm-6"><label for="exampleInputEmail1">Type Munition</label><select name="munitions[]" id="munitions"> @foreach($munitions as $munition)<option value="{{ $munition->id }}">{{ $munition->type }}</option>@endforeach</select></div>');

            // Champ de quantité
            var quantiteInput = $('<div class="form-group col-sm-4"><label for="exampleInputEmail1">Quantité</label><input type="number" name="quantitemunition[]" class="form-control"></div>');

            // Bouton de suppression
            // var removeButton = $('<div class="form-group col-sm-2 d-flex align-items-end"><button type="button" class="remove-arme" >Supprimer</button></div>');
            var removeButton = $('<div class="form-group col-sm-2 d-flex align-items-end"><button type="button" class="remove-munition btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></div>');

            // Ajouter les sélecteurs, le champ de quantité et le bouton à l'élément div
            munitionDiv.append(nomMunitionSelect, quantiteInput, removeButton);

            // Ajouter l'élément div au conteneur "armes"
            $('#munitions').append(munitionDiv);
        });

        $('#munitions').on('click', '.remove-munition', function() {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette munition ?")) {
            $(this).parent().parent().remove(); // Supprimer le div parent
        }
    });
    });
</script>

<script>
    $(document).ready(function() {
     $('#add-optique').click(function() {
         // Créer un élément div pour chaque optique
         var optiqueDiv = $('<div class="row"></div>');

         // Sélecteur pour le nom de l'optique
         var nomOptiqueSelect = $('<div class="form-group col-sm-6"><label for="exampleInputEmail1">Type Optique</label><select name="optiques[]" id="optiques"> @foreach($optiques as $optique)<option value="{{ $optique->id }}">{{ $optique->type }}</option>@endforeach</select></div>');

         // Champ de quantité
         var quantiteInput = $('<div class="form-group col-sm-4"><label for="exampleInputEmail1">Quantité</label><input type="number" name="quantiteoptique[]" class="form-control"></div>');

         // Bouton de suppression
         var removeButton = $('<div class="form-group col-sm-2 d-flex align-items-end"><button type="button" class="remove-optique btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button></div>');

         // Ajouter les sélecteurs, le champ de quantité et le bouton à l'élément div
         optiqueDiv.append(nomOptiqueSelect, quantiteInput, removeButton);

         // Ajouter l'élément div au conteneur "optiques"
         $('#optiques').append(optiqueDiv);
     });

     $('#optiques').on('click', '.remove-optique', function() {
         if (confirm("Êtes-vous sûr de vouloir supprimer cet optique ?")) {
             $(this).parent().parent().remove(); // Supprimer le div parent
         }
     });
 });

 </script>




<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg">
                    Créer une dotation
            </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


            <!--  modale -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cration d'une dotation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="wizard">
                                <h2 class="text-center">Reférence de la personne</h2>

                                <form method="POST" action="{{route('store.dotation')}}" class="forms-sample" enctype="multipart/form-data">
                                            @csrf
                                    <section>
                                        {{-- personnel_id	date_dotation	date_reintegration	etat_reintegration	motif_reintegration --}}
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Nom personne<span class="etoile">*</span></label>
                                                        <select class="@error('personnel') is-invalid @enderror" name="personnel">
                                                            @foreach($personnels as $personnel)
                                                                <option value="{{ $personnel->id }}">{{ $personnel->nom }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('nom')
                                                            <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                        </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Date de dotation<span class="etoile">*</span></label>
                                                        <input type="date" class="form-control @error('date_dotation') is-invalid @enderror" name="date_dotation" autocomplete="off" value="">
                                                        @error('date_dotation')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    </div>
                                                </div><!-- Col -->
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Date de reintégration<span class="etoile">*</span></label>
                                                        <input type="date" class="form-control @error('date_reintegration') is-invalid @enderror" name="date_reintegration" autocomplete="off" value="">
                                                        @error('date_reintegration')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    </div>
                                                </div><!-- Col -->



                                            </div><!-- Row -->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputUsername1">Etat de dotation</label>
                                                        <select class="form-control @error('etat_reintegration') is-invalid @enderror" name="etat_reintegration">
                                                            <option value="" disabled selected>Choisissez un état</option>
                                                            @foreach(['En cours',"Expiré",] as $option)
                                                                <option value="{{ $option }}" >{{ $option }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('status')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Motif de dotation<span class="etoile">*</span></label>
                                                        <input type="text" class="form-control @error('motif_reintegration') is-invalid @enderror" name="motif_reintegration" placeholder="Entrer le motif de dotation">
                                                        @error('motif_reintegration')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    </div>
                                                </div><!-- Col -->
                                            </div>


                                            <br>

                                            <h2 class="text-center">Matériels</h2>
                                            <br>

                                            <button type="button" id="add-arme" class="btn btn-success">
                                                <i class="fas fa-crosshairs"></i> Ajouter Arme
                                            </button>

                                                <div class="row" id="armes">
                                                    <div class="form-group col-sm-4" >
                                                        <label for="exampleInputEmail1">Nom Arme<span class="etoile">*</span></label>

                                                            <select  class="form-control" name="armes[]">
                                                                @foreach($armes as $arme)
                                                                    <option value="{{ $arme->id }}">{{ $arme->nom }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('nom')
                                                            <span class="text-danger">{{$message}}</span>
                                                        @enderror

                                                    </div>

                                                    <div class="form-group col-sm-4">
                                                        <label for="exampleInputEmail1">Quantité<span class="etoile">*</span></label>
                                                        <input type="number" name="quantitearme[]" id="quantitearme" class="form-control @error('quantitearme') is-invalid @enderror" >
                                                        @error('quantitearme')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    {{--  --}}
                                                </div>
                                                <br>
                                                <button type="button" id="add-munition" class="btn btn-success">
                                                    <i class="fas fa-bullseye"></i> Ajouter Munition
                                                </button>

                                                <div class="row" id="munitions">
                                                            <div class="form-group col-sm-4">
                                                                <label for="exampleInputEmail1">Type Munition<span class="etoile">*</span></label>
                                                                <select  class="form-control" name="munitions[]">
                                                                    @foreach($munitions as $munition)
                                                                        <option value="{{ $munition->id }}">{{ $munition->type }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('type')
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <label for="quantite">Quantité</label>
                                                                <input type="number" name="quantitemunition[]" id="quantitemunition" class="form-control @error('quantitemunition') is-invalid @enderror" >
                                                                @error('quantitemunition')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                </div>
                                                <br>
                                                <button type="button" id="add-optique" class="btn btn-success">
                                                    <i class="fas fa-location-arrow"></i> Ajouter Optique
                                                </button>

                                                <div class="row" id="optiques">
                                                    <div class="form-group col-sm-4">
                                                        <label for="exampleInputEmail1">Type Optique<span class="etoile">*</span></label>
                                                        <select  class="form-control" name="optiques[]">
                                                            @foreach($optiques as $optique)
                                                                    <option value="{{ $optique->id }}">{{ $optique->type }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label for="quantite">Quantité<span class="etoile">*</span></label>
                                                        <input type="number" name="quantiteoptique[]" id="quantiteoptique" class="form-control @error('quantiteoptique') is-invalid @enderror" >
                                                        @error('quantiteoptique')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>


                                    </section>
                                    <div class="modal-footer">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                            <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save"></i> Enregistrer
                                        </button>
                                    </div>

                                </form >
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title font-weight-bold">Liste des dotations</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                  <th >Id#</th>
                                  <th>Nom Personne</th>
                                  <th>Date de dotation</th>
                                  <th>Date de réintégration</th>
                                  <th>Etat de dotation</th>
                                  <th>Motif de dotation</th>
                                <th>Action</th>

                                </tr>
                              </thead>

                              <tbody>
                                {{--
id
personnel_id
date_dotation

 --}}
                                @foreach ($dotations as $key => $item )
                                <tr>
                                  <td>{{$key + 1}}</td>
                                  <td>{{$item->personnel->nom}}</td>
                                  <td>{{$item->date_dotation}}</td>
                                  <td>{{$item->date_reintegration}}</td>
                                  <td>{{$item->etat_reintegration}}</td>
                                  <td>{{$item->motif_reintegration}}</td>


                                    <td>
                                        <!-- Button to trigger the modal -->
                                        {{-- <button type="button" class="btn btn-inverse-warning" data-toggle="modal"
                                            data-target="#editModal{{$item->id}}">
                                            <i data-feather="edit"></i>
                                        </button> --}}
                                        <!-- Edit Modal -->

                                        {{--  --}}

                                        <!-- affiché plus de detail -->
                                    {{-- <button type="button" class="btn btn-inverse-info " data-toggle="modal"data-target="#allModal{{$item->id}}">
                                        <i class="fas fa-info-circle text-info"></i>

                                   </button> --}}

                                    <!-- affiché plus de detail -->
                                    <button type="button" class="btn btn-inverse-info " data-toggle="modal"data-target="#allModal{{$item->id}}">
                                        <i class="fas fa-info-circle text-info"></i>

                                   </button>

                                <div class="modal fade bd-example-modal-lg" id="allModal{{$item->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Info sur la dotation
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form to edit the specific item using its ID -->
                                                <div class="card">
                                                    <div class="card-body">

                                                            <style>
                                                                body{
                                                                    background-color: #F6F6F6;
                                                                    margin: 0;
                                                                    padding: 0;
                                                                }
                                                                h1,h2,h3,h4,h5,h6{
                                                                    margin: 0;
                                                                    padding: 0;
                                                                }
                                                                p{
                                                                    margin: 0;
                                                                    padding: 0;
                                                                }
                                                                .container{
                                                                    width: 80%;
                                                                    margin-right: auto;
                                                                    margin-left: auto;
                                                                }
                                                                .brand-section{
                                                                   background-color: #0d1033;
                                                                   padding: 10px 40px;
                                                                }
                                                                .logo{
                                                                    width: 50%;
                                                                }

                                                                .row{
                                                                    display: flex;
                                                                    flex-wrap: wrap;
                                                                }
                                                                .col-6{
                                                                    width: 50%;
                                                                    flex: 0 0 auto;
                                                                }
                                                                .text-white{
                                                                    color: #fff;
                                                                }
                                                                .company-details{
                                                                    float: right;
                                                                    text-align: right;
                                                                }
                                                                .body-section{
                                                                    padding: 16px;
                                                                    border: 1px solid gray;
                                                                }
                                                                .heading{
                                                                    font-size: 20px;
                                                                    margin-bottom: 08px;
                                                                }
                                                                .sub-heading{
                                                                    color: #262626;
                                                                    margin-bottom: 05px;
                                                                }
                                                                table{
                                                                    background-color: #fff;
                                                                    width: 100%;
                                                                    border-collapse: collapse;
                                                                }
                                                                table thead tr{
                                                                    border: 1px solid #111;
                                                                    background-color: #f2f2f2;
                                                                }
                                                                table td {
                                                                    vertical-align: middle !important;
                                                                    text-align: center;
                                                                }
                                                                table th, table td {
                                                                    padding-top: 08px;
                                                                    padding-bottom: 08px;
                                                                }
                                                                .table-bordered{
                                                                    box-shadow: 0px 0px 5px 0.5px gray;
                                                                }
                                                                .table-bordered td, .table-bordered th {
                                                                    border: 1px solid #dee2e6;
                                                                }
                                                                .text-right{
                                                                    text-align: end;
                                                                }
                                                                .w-20{
                                                                    width: 20%;
                                                                }
                                                                .float-right{
                                                                    float: right;
                                                                }
                                                            </style>
                                                        </head>
                                                        <body>

                                                            <div class="container">

                                                                <div class="body-section">
                                                                    <div class="row">

                                                                        <div class="col5">
                                                                            <div class="form-group">
                                                                                <h2 class="heading">Dotation N°:A000{{ $item->id}}</h2>
                                                                                <h2 class="heading">Motif de la dotation:{{ $item->motif_reintegration}}</h2><p></p>
                                                                            <p class="sub-heading">Date de dotation:{{ $item->date_dotation}} </p>
                                                                            <p class="sub-heading">Date de l'intégration:{{ $item->date_reintegration}} </p>

                                                                            </div>
                                                                        </div>
                                                                        {{--
                                                                                id
                                                                                personnel_id


                                                                                etat_reintegration
                                                                                 --}}

                                                                        <div class="col4">
                                                                            <div class="form-group">
                                                                                <p>Au profil de:</p>
                                                                            <p class="sub-heading">Matricule:{{ $item->personnel->matricule }}  </p>
                                                                            <p class="sub-heading">Nom: {{ $item->personnel->nom }} </p>
                                                                            <p class="sub-heading">Prenom:{{$item->personnel->prenom }}  </p>
                                                                            <p class="sub-heading">Grade: {{ $item->personnel->grade }} </p>
                                                                            <p class="sub-heading">Reference CNIB: B85000 </p>
                                                                            <p class="sub-heading">N° de Telephone: {{ $item->personnel->numeroTelephone }} </p>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="body-section">
                                                                    <h3 class="text-center">Dotation pour</h3>
                                                                    <br>
                                                                    <table class="table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Libellé</th>
                                                                                <th class="text-right">Quantité</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($item->armes as $arme)
                                                                                <tr>
                                                                                    <td>Arme</td>
                                                                                    <td>{{ $arme->nom }}</td>
                                                                                    <td class="text-right">{{ $arme->pivot->quantitearme }}</td>

                                                                                    {{-- <td class="text-right">
                                                                                        @if ($arme->armes) <!-- Vérifiez si la relation Arme existe -->
                                                                                        {{ $arme->armes->quantitearme }} <!-- Accédez au nom du type d'arme -->
                                                                                        @else
                                                                                            Aucune quantité d'arme associé
                                                                                        @endif
                                                                                    </td> --}}
                                                                                </tr>
                                                                            @endforeach

                                                                            @foreach ($item->munitions as $munition)
                                                                                <tr>
                                                                                    <td>Munition</td>
                                                                                    <td>{{ $munition->type }}</td>

                                                                                    <td class="text-right">{{ $munition->pivot->quantitemunition }}</td>
                                                                                </tr>
                                                                            @endforeach

                                                                            @foreach ($item->optiques as $optique)
                                                                                <tr>
                                                                                    <td>Optique</td>
                                                                                    <td>{{ $optique->type }}</td>


                                                                                    <td class="text-right">{{ $optique->pivot->quantiteoptique }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>






                                                                </div>





                                                                    <button type="button" class="btn btn-secondary"data-dismiss="modal">Fermer</button>


                                                                </div>

                                                            </div>

                                                            {{-- <a href="/generate-pdf">Telecharger</a> --}}




                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>


                                        <a href="{{route('delete.dotation',$item->id)}}" class="btn btn-inverse-danger"
                                            id="delete"><i data-feather="trash-2"></i></a>

                                            <a href="{{ route('telecharg.pdf', ['id' => $item->id]) }}" class="btn btn-inverse-success">
                                                <i class="fas fa-download"></i>
                                            </a>



                                    </td>


                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




<div class="d-flex justify-content-end">

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</div>


@endsection




