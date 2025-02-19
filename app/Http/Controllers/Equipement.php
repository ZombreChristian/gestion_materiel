<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;

class EquipementController extends Controller
{
    //
    public function index()
    {
        $equipements = Equipement::all();
        return view('index', compact('equipements'));
    }
}
