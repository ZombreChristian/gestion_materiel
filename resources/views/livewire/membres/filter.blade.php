
<form method="get" action="{{route('admin.membres.filter.membre')}}">

    <div class="row filter-row">

        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
            <div class="form-group form-focus">
                <label >nom</label>
                <input type="text" class="form-control"  name="nom" placeholder="">

            </div>
        </div>

        {{-- <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
            <div class="form-group form-focus">
                <label >sexe</label>
                <input type="text" class="form-control" name="sexe" placeholder="">

            </div>
        </div> --}}
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
            <div class="form-group form-select">
                <label >Prénom</label>
                <input type="text" class="form-control" name="prenom" placeholder="prenom">

            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
            <div class="form-group form-focus">
                <label >Sexe</label>
            <select class="form-control @error('sexe') is-invalid @enderror" name="sexe" >
                <option value="">---------</option>
                <option value="M">Homme</option>
                <option value="F">Femme</option>
            </select>

            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
            <div class="form-group form-focus">
                <label >Télephone1</label>
                <input type="number" class="form-control " name="telephone1" placeholder="71253698">

            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
            <div class="form-group form-focus">
                <label >Date de Naissande</label>
                <input type="date" class="form-control " name="dateNaissance" placeholder="02/10/2000">

            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
            <div class="form-group form-focus">
                <label >Recherche</label>

                    <button type="submit" class="btn btn-success" name="search" ><i class="fas fa-search"></i></button>

            </div>
        </div>


    </div>

    {{-- <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>

        </div>
    </div> --}}
    {{-- <div class="input-group-append">
        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
    </div> --}}

</form>

