<?php

namespace App\Livewire;

use Livewire\Component;

class TypeMaterielIndex extends Component
{

    public $types;

    public function mount()
    {
        $this->types = TypeMateriel::all();
    }

    public function render()
    {
        return view('livewire.type-materiel-index');
    }
}
