<?php

namespace App\Livewire;
use Livewire\WithPagination;

use App\Models\User;



use Livewire\Component;

class Membre extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()

    {
        // return view('livewire.membre');
        return view('livewire.membres.index', [
            "membres" => Membre::latest()->paginate(5),
            

        ])
        ->extends('layouts.master')
        ->section("contenu");
    }


    // public function AllMembre(){

    //     Carbon::setLocale("fr");
    //     $membres = Membre::latest()->paginate(2);



    //     return view('livewire.membres.index', compact('membres'))
    //     ->extends('layouts.master')
    //     ->section("contenu");
    //  }
}
