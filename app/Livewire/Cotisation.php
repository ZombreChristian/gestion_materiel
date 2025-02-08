<?php

namespace App\Livewire;

use Livewire\Component;
// use App\models\Cotisation;

class Cotisation extends Component
{
    public function render()
    {
        // return view('livewire.cotisations.index', [
        //     "cotisations" => Cotisation::latest()->paginate(5)
        // ])
        // ->extends('layouts.master')
        // ->section("contenu");

        $users = Cotisation::latest()->get();
        return view('livewire.cotisations.index',compact('users'));

    }
}
