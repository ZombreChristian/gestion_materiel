<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cotisation;

class Quota extends Component
{
    public function render()
    {
        return view('livewire.cotisations.index', [
            "users" => Cotisation::latest()->paginate(5)
        ])
        ->extends('layouts.master')
        ->section("contenu");
    }
}
