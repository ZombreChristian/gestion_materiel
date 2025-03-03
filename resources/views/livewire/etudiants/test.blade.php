
{{-- <div class="col-6">
    <img src="{{ $item->membres->sexe == 'F' ? asset('images/woman.png') : asset('images/man.png') }}" class="card-img-top" alt="...">

</div> --}}

{{-- <div class="text-left">
    <p>date</p>
    <p>Lieur</p>
    <img class="profile-user-img img-fluid img-circle" src="{{ $item->membres->sexe == 'F' ? asset('images/woman.png') : asset('images/man.png') }}" alt="User profile">

</div> --}}

<div class="row">
    <div class="col-2">
        <img class="profile-user-img img-fluid img-circle" src="{{ $item->membres->sexe == 'F' ? asset('images/woman.png') : asset('images/man.png') }}" alt="User profile">

    </div>

    <div class="col-10" style="position: left">
        <p>

                Nom: <strong>@if ($item->membres)
            {{$item->membres->nom}}

           @else
           aucun membre
           @endif
            </strong>
        </p>
<p>Prénom:@if ($item->membres)
      {{$item->membres->prenom}}

   @else
   aucun membre
   @endif</p>
    <p>Né: {{$item->membres->dateNaissance}}</p>
    <p>Lieu : {{$item->membres->lieuNaissance}}</p>
    <p>Nationalité:{{$item->membres->nationalite}}</p>
    <p>pays:{{$item->membres->pays}}</p>

    </div>

</div>


<div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
    <table class="table table-head-fixed">
        <thead>
          <tr>

            <th >Ordre</th>
            <th >Nom/prénom</th>
            <th >Montant emprunté</th>
            <th >Montant payé</th>
            <th >Montant restant</th>

            {{-- <th style="width:15%;" class="text-center">Ajouté</th> --}}
          </tr>
        </thead>
        <tbody>
            {{-- @foreach ($cotisations as $key=>$item) --}}

          <tr>

             <td>#</td>
            <td>
              <strong>
                @if ($item->membres)
              {{$item->membres->nom}}  {{$item->membres->prenom}}

             @else
             aucun membre
             @endif
              </strong>
          </td>



          <td >
            <strong><a style="color: red">{{ number_format($item->membres->montant,0, ',', ' ') }} </a> FCFA</strong>
          </td>

          <td>
            <strong><a style="color: red">{{ number_format($item->somme_montants,0, ',', ' ') }} </a>FCFA</strong>
          </td>



          <td>
            <strong><a style="color: red">{{ number_format($item->membres->montant - $item->somme_montants,0, ',', ' ') }}</a> FCFA</strong>
          </td>







          </tr>
          {{-- @endforeach --}}

        </tbody>
    </table>
</div>
