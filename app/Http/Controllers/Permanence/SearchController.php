<?php

namespace App\Http\Controllers\Permanence;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permanences;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Effectuez votre recherche en fonction de la valeur de la requête ($query)
        // Obtenez les résultats et renvoyez-les au format JSON
        // $results = ... Logique de recherche ...
    
        return response()->json(['results' => $results]);
    }
    
}
