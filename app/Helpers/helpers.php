<?php
use Illuminate\Support\Str;


define("PAGELIST", "liste");
define("PAGECREATEFORM", "create");
define("PAGEEDITFORM", "edit");

define("DEFAULTPASSOWRD", "password");



// function userFullName(){

//     return  auth()->user()->prenom . " " . auth()->user()->nom;
// }

function userFullName(){
    $user = auth()->user();

    return $user ? $user->name : 'Utilisateur non connecté';
}

// function userFullName() {
//     // Check if the user is authenticated
//     if (auth()->check()) {
//         // Check if the user object has 'prenom' and 'nom' properties
//         $user = auth()->user();
//         if (property_exists($user, 'prenom') && property_exists($user, 'nom')) {
//             return $user->prenom . " " . $user->nom;
//         } else {
//             return "User object does not have expected properties.";
//         }
//     } else {
//         return "User is not authenticated.";
//     }
// }


function setMenuClass($route, $classe){
    $routeActuel = request()->route()->getName();

    if(contains($routeActuel, $route) ){
        return $classe;
    }
    return "";
}

function setMenuActive($route){
    $routeActuel = request()->route()->getName();

    if($routeActuel === $route ){
        return "active";
    }
    return "";
}


// pour verifier le contenu
function contains($container, $contenu){
    return Str::contains($container, $contenu);
}


function getRolesName() {
    $user = auth()->user();

    if ($user) {
        $rolesName = "";
        $i = 0;

        foreach ($user->roles as $role) {
            $rolesName .= $role->name;


        }

        return $rolesName;
    } else {
        return 'Utilisateur non connecté';
    }
}

