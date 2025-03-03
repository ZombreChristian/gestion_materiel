<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\AdminController;

use App\Http\Livewire\TypeMaterielComp;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\PdfgenerateController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\admin\EtudiantController;
// use App\Http\Controllers\TypeMaterielController;
use App\Http\Controllers\ProprietaireMaterielController;
use App\Http\Controllers\admin\MaterielController;

use App\Http\Controllers\admin\ReservationController;
use App\Http\Controllers\admin\TypeMaterielController;
use App\Livewire\Utilisateurs;
use App\Models\Etudiant;

Route::get('/', function () {
    return view('index');
});

Route::get('/forgetpassword', function () {

    return view('auth.forgot-password');
});


Route::get('/signup', function (){
    return view('signup');
})-> name('signup');

Route::get('/contact', function (){
    return view('contact');
})-> name('contact');

Route::get('/home_admin', function (){
    return view('home_admin');
})-> name('home_admin');



Route::get("/ges_reservation", [ReservationController::class, "index"]);

//Route::resource("/ges_reservation", TypeMaterielController::class);

Route::resource("/reservation/materiel", MaterielController::class);



Route::resource('typeMateriel', TypeMaterielController::class);// Route pour afficher le formulaire de modification
// Route::get('typeMateriel/{id}/edit', [TypeMaterielController::class, 'edit'])->name('typeMateriel.edit');

// Route pour mettre à jour le type de matériel
// Route::put('typeMateriel/{id}', [TypeMaterielController::class, 'update'])->name('typeMateriel.update');

Route::resource('proprietaireMateriel', ProprietaireMaterielController::class);
// Route::get("/prendre_mat/{ref}", [ReservationController::class, "prendre_mat"]);



Route::resource('reservation', ReservationController::class);



Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::get('/logoute', [AdminController::class, 'AdminLogout'])->name('logoute');

Route::middleware('auth')->group(function () {
Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('profile');
Route::post('/profile/store', [AdminController::class, 'AdminProfileStore'])->name('profile.store');
Route::get('/change/password', [AdminController::class, 'AdminChangePassword'])->name('change.password');
Route::post('/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
});
require __DIR__.'/auth.php';


// start groupe Admin Middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    // Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

//------------------------------------------------------------------

}); // end groupe Admin Middleware


Route::group([
    // "middleware" => ["auth", "auth.admin"],
    'as' => 'admin.'
], function(){

    Route::group([
        "prefix" => "roles",
        'as' => 'roles.'
    ], function(){

       // Route::get("/articles", ArticleComp::class)->name("articles");
        Route::controller(AdminController::class)->group(function(){
            Route::get('/all/admin','AllAdmin')->name('all.admin');
            Route::post('/store/admin','StoreAdmin')->name('store.admin');
            Route::post('/update/admin{id}','UpdateAdmin')->name('update.admin');
            Route::get('/delete/admin/{id}','DeleteAdmin')->name('delete.admin');
        });

        Route::controller(RoleController::class)->group(function(){
            Route::get('/all/roles','AllRole')->name('all.roles');
            Route::get('/add/roles','AddRole')->name('add.roles');
            Route::post('/store/roles','StoreRole')->name('store.roles');
            Route::get('/edit/roles/{id}','EditRole')->name('edit.roles');
            Route::post('/update/roles','UpdateRole')->name('update.roles');
            Route::get('/delete/roles/{id}','DeleteRole')->name('delete.roles');

            Route::get('/all/permission','AllPermission')->name('all.permission');
            Route::get('/add/permission','AddPermission')->name('add.permission');
            Route::post('/store/permission','StorePermission')->name('store.permission');
            Route::get('/edit/permission/{id}','EditPermission')->name('edit.permission');
            Route::post('/update/permission','UpdatePermission')->name('update.permission');
            Route::get('/delete/permission/{id}','DeletePermission')->name('delete.permission');
            Route::get('/import/permission','ImportPermission')->name('import.permission');

            Route::get('/export','Export')->name('export');
            Route::post('/import','Import')->name('import');

            // Roles of permission All Route
            Route::get('/add/roles/permission','AddRolesPermission')->name('add.roles.permission');
            Route::post('/role/permission/store','RolesPermissionStore')->name('role.permission.store');
            Route::get('/all/roles/permission','AllRolesPermission')->name('all.roles.permission');
            Route::get('/admin/edit/roles/{id}','AdminEditRoles')->name('admin.edit.roles');
            Route::post('/admin/roles/update/{id}','AdminRolesUpdate')->name('admin.roles.update');
            Route::get('/admin/delete/roles/{id}','AdminDeleteRoles')->name('admin.delete.roles');
        });

    });

});
// ------------------------------------------------------------------------------------------

// Route::get('/generate-pdf','PdfgenrateController@generatePDF');->middleware('permission:test1')
Route::get('/generate-pdf',    [PdfgenerateController::class, 'generatePDF'])->name('pdf');

Route::get('/telecharger-pdf/{id}',  [PdfgenerateController::class, 'telechargerPdf'])->name('telecharger.pdf');

Route::group([
    // "middleware" => ["auth", "auth.admin"],
    'as' => 'admin.'
], function(){
    Route::group([
        "prefix" => "habilitations",
        'as' => 'habilitations.'
    ], function(){

        Route::get("/utilisateurs", Utilisateurs::class)->name("users.index");

    });
});


Route::group([
    "prefix" => "etudiants",
    'as' => 'etudiants.'
], function(){

    Route::controller(EtudiantController::class)->group(function(){

        Route::get('/all','AllEtudiant')->name('all.etudiant');
        // Route::get('/add/Patient','AddMembre')->name('add.membre');
        Route::post('/store','StoreMembre')->name('store.etudiant');
        Route::post('/update','UpdateMembre')->name('update.etudiant');
        Route::get('/delete/{id}','DeleteMembre')->name('delete.etudiant');

        Route::get('/search','Search')->name('cherche.etudiant');
        Route::get('/filter','Filter')->name('filter.etudiant');


    });
});

Route::group([
    "prefix" => "equipements",
    'as' => 'equipements.'
], function(){

    Route::controller(MaterielController::class)->group(function(){

        Route::get('/all_equipement','AllEtudiant')->name('all.equipement');
        // Route::get('/add/Patient','AddMembre')->name('add.membre');
        Route::post('/store_equipement','StoreMembre')->name('store.equipement');
        Route::post('/update_equipement','UpdateMembre')->name('update.equipement');
        Route::get('/delete_equipement/{id}','DeleteMembre')->name('delete.equipement');

        Route::controller(TypeMaterielController::class)->group(function(){
            Route::get('/all_type','AllEtudiant')->name('all.type');
            // Route::get('/add/Patient','AddMembre')->name('add.membre');
            Route::post('/store_type','StoreMembre')->name('store.type');
            Route::post('/update_type','UpdateMembre')->name('update.type');
            Route::get('/delete_type/{id}','DeleteMembre')->name('delete.type');

        });





    });
});


Route::group([
    "prefix" => "reservations",
    'as' => 'reservations.'
], function(){

    Route::controller(ReservationController::class)->group(function(){

        Route::get('/all_reservation','AllEtudiant')->name('all.reservation');
        // Route::get('/add/Patient','AddMembre')->name('add.membre');
        Route::post('/store_reservation','StoreMembre')->name('store.reservation');
        Route::post('/update_reservation','UpdateMembre')->name('update.reservation');
        Route::get('/delete_reservation/{id}','DeleteMembre')->name('delete.reservation');

    });



});


// Route::group([
//     "prefix" => "typesMateriels",
//     'as' => 'typesMateriels.'
// ], function(){

//     Route::controller(TypeMaterielController::class)->group(function(){
//         Route::get('/all_type','AllEtudiant')->name('all.type');
//         // Route::get('/add/Patient','AddMembre')->name('add.membre');
//         Route::post('/store_type','StoreMembre')->name('store.type');
//         Route::post('/update_type','UpdateMembre')->name('update.type');
//         Route::get('/delete_type/{id}','DeleteMembre')->name('delete.type');

//     });
// });

