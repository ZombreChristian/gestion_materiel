<?php
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\GestionnaireController;
use App\Http\Controllers\SymptomeController;
use App\Http\Controllers\ReportController;




// use App\Http\Controllers\PersonnelController;

use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\MoyenmissionController;
use App\Http\Controllers\EvenmissionController;
use App\Http\Controllers\Backend\RoleController;

use App\Http\Controllers\AMO\ArmeController;

use App\Http\Controllers\PdfgenerateController;
use App\Http\Controllers\Bon\BonController;
use App\Http\Controllers\Dotation\DotationController;

use App\Livewire\Counter;

use App\Http\Controllers\CotisationController;
use App\Http\Controllers\MembreController;

use App\Http\Controllers\UserController;
use App\Livewire\Utilisateurs;
use App\Models\Patient;
use App\Models\User;
use App\Livewire\Membre;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/forgetpassword', function () {

    return view('auth.forgot-password');
});


// Route::get('/about', function () {
//     return 'Aboute page';
// });




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
// routes/web.php
// Route pour exporter en PDF
Route::get('/export-pdf', [ReportController::class, 'exportPdf']);

// Route pour exporter en Excel
Route::get('/export-excel', [ReportController::class, 'exportExcel']);


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::middleware('auth')->group(function () {
// Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('logout');
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


//------------------------------------------------------------------



}); // end groupe Admin Middleware


// Route::get("/membres", Membre::class)->name("membres.index");
// // Route::get("/cotisations", Cotisation::class)->name("cotisations.index");
// Route::get('/cotisations', [CotisationController::class, 'render'])->name('cotisations.index');
// Route::post('/store/cotisations', [CotisationController::class, 'storeCotisation'])->name('store.cotisation');




// ----------------------------------------------------------------------------

// Route::middleware(['auth', 'roles:admin'])->group(function () {
//     // admin create users
//     Route::controller(AdminController::class)->group(function(){
//         Route::get('/all/admin','AllAdmin')->name('all.admin');
//         Route::get('/add/admin','AddAdmin')->name('add.admin');
//         Route::post('/store/admin','StoreAdmin')->name('store.admin');
//         Route::get('/edit/admin/{id}','EditAdmin')->name('edit.admin');
//         Route::post('/update/admin/{id}','UpdateAdmin')->name('update.admin');
//         Route::get('/delete/admin/{id}','DeleteAdmin')->name('delete.admin');
//     });

// });

// ----------------------------------


// -----------------------------------------------------------------------------------------------

Route::group([
    // "middleware" => ["auth", "auth.admin"],
    'as' => 'admin.'
], function(){

    Route::group([
        "prefix" => "roles",
        'as' => 'roles.'
    ], function(){

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


            //

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
            Route::get('/reports/generate', [RapportController::class, 'generate'])->name('reports.generate');            

        });

    });

    // Route::get("/membres", Membre::class)->name("membres.index");
    // // Route::get("/cotisations", Cotisation::class)->name("cotisations.index");
    // Route::get('/cotisations', [CotisationController::class, 'render'])->name('cotisations.index');
    // Route::post('/store/cotisations', [CotisationController::class, 'storeCotisation'])->name('store.cotisation');


    Route::group([
        "prefix" => "membres",
        'as' => 'membres.'
    ], function(){

        Route::controller(MembreController::class)->group(function(){

            Route::get('/all','AllMembre')->name('all.membre');
            // Route::get('/add/Patient','AddMembre')->name('add.membre');
            Route::post('/store','StoreMembre')->name('store.membre');
            Route::post('/update','UpdateMembre')->name('update.membre');
            Route::get('/delete/{id}','DeleteMembre')->name('delete.membre');

            Route::get('/search','Search')->name('cherche.membre');
            Route::get('/filter','Filter')->name('filter.membre');
            





        });
    });

    Route::group([
        "prefix" => "cotisations",
        'as' => 'cotisations.'
    ], function(){

        Route::controller(CotisationController::class)->group(function(){

            Route::get('/liste', 'AllCotisation')->name('all.cotisation');
            Route::get('/semaine', 'Semaine')->name('semaine.cotisation');


            Route::post('/store', 'StoreCotisation')->name('store.cotisation');
            Route::get('/delete/{id}','DeleteCotisation')->name('delete.cotisation');

            Route::get('/cherche','SearchCotisation')->name('cherche.paiement');

            Route::get('/filter','Filter')->name('filter.cotisation');


            // Route::get('/sommeMensuelle', 'sommeMensuelleParMembre')->name('somme.mensuelle');








            // Route::post('/store/Symptome','StoreSymptome')->name('store.symptome');
            // Route::post('/update/Symptome','UpdateSymptome')->name('update.symptome');
            // Route::get('/delete/Symptome/{id}','DeleteSymptome')->name('delete.symptome');

        });
    });

});
// ------------------------------------------------------------------------------------------

                Route::get('/paiement/{id}', [AdminController::class, 'AllMensuelle'])->name('all.paiement');



Route::group([
    // "middleware" => ["auth", "auth.admin"],
    'as' => 'gestionnaire.'
], function(){




});

// Route::get('/generate-pdf','PdfgenrateController@generatePDF');->middleware('permission:test1')
Route::get('/generate-pdf',    [PdfgenerateController::class, 'generatePDF'])->name('pdf');

Route::get('/telecharger-pdf',  [ArmeController::class, 'telechargerPdf'])->name('telecharger');


Route::get('/telecharger-pdf/{id}',  [PdfgenerateController::class, 'telechargerPdf'])->name('telecharger.pdf');

Route::get('/telecharg-pdf/{id}',  [DotationController::class, 'telechargerPdf'])->name('telecharg.pdf');


// Route::get('/telecharger-pdf/{id}', 'BonController@telechargerPdf')->name('telecharger.pdf');



// Le groupe des routes relatives aux administrateurs uniquement
Route::group([
    // "middleware" => ["auth", "auth.admin"],
    'as' => 'admin.'
], function(){
    Route::group([
        "prefix" => "habilitations",
        'as' => 'habilitations.'
    ], function(){

        Route::get("/utilisateurs", Utilisateurs::class)->name("users.index");
        Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');

    });
});









// Route::get("/membres", Membre::class)->name("membres.index");
// // Route::get("/cotisations", Cotisation::class)->name("cotisations.index");
// Route::get('/cotisations', [App\Livewire\Cotisation::class, 'render'])->name('cotisations.index');
// Route::post('/store/cotisations', [App\Livewire\Cotisation::class, 'storeCotisation'])->name('store.cotisation');





// Routes moto


// Routes vehicule

