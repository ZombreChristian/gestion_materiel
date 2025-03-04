<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TypeMateriel;
use App\Models\Materiel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Livewire\WithPagination;

class MaterielController extends Controller
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function AllMateriel(){

        Carbon::setLocale("fr");
        $materiels = Materiel::latest()->paginate(25);
        

        $typesMateriel = TypeMateriel::all();

        return view('livewire.materiels.index', compact('materiels','typesMateriel'));

     }


     /**
      * Show the form for creating a new resource.
      */
     public function create()
     {
         //
         $categories= TypeMateriel::all();
         return view('admin.ajouterproduit',compact('categories'));
     }

     /**
      * Store a newly created resource in storage.
      */
      public function StoreMateriel(Request $request)
      {
        // dd($request->all());
          $request->validate([
              'imageUrl' => 'nullable|image|max:4999|mimes:png,jpg,jpeg,webp',
              'type_materiel_id' => 'required',
              'nom' => 'required|unique:materiels'
          ]);

          if ($request->hasFile('imageUrl')) { // RECUPERER l'image
              $fileNameWithExt = $request->file('imageUrl')->getClientOriginalName();
              $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
              // extraire l'extension de l'image
              $extension = $request->file('imageUrl')->getClientOriginalExtension();
              // générer un nom unique pour l'image
              $filenameToStore = $fileName . '_' . time() . '.' . $extension;
              // schema de stockage de l'image
              $path = $request->file('imageUrl')->storeAs('public/materiels', $filenameToStore);
          } else {
              $filenameToStore = 'noimage.jpg';
          }


            $estDisponible = $request->has('estDisponible') ? $request->estDisponible : 1;

          Materiel::create([
              'nom' => $request->nom,
              'noSerie' => $request->noSerie,
              'date_acquisition' => $request->date_acquisition,
              'description' => $request->description,
              'imageUrl' => $filenameToStore,
              'type_materiel_id' => $request->type_materiel_id,
             'estDisponible' => $estDisponible,
          ]);

          $notification = array(
              'message' => 'Materiel a été créé avec succès',
              'alert-type' => 'success'
          );

          return redirect()->route('equipements.all.equipement')->with($notification);
      }


     /**
      * Display the specified resource.
      */
     public function show(string $id)
     {
         //
     }

     /**
      * Show the form for editing the specified resource.
      */
     public function edit(string $id)
     {
         //
         $produits = Materiel::findOrFail($id);
         $categories= TypeMateriel::all();

         return view('admin.editproduit', compact('produits','categories'));
     }

     /**
      * Update the specified resource in storage.
      */
     public function UpdateMateriel(Request $request)
     {
         $pid =$request->id;
         $request->validate ([
             'image'=>'image|nullable|max:1999|mimes:png,jpg,jpeg,webp',
             'category'=>'required',
             'nom'=>'required',
             'prix'=>'required',

         ]);
         $produit = Materiel::findOrFail($pid);

         if($request->has('image')){ // RECUPERER l'image
             $fileNameWithExt = $request->file('image')->getClientOriginalName();
             $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
             // extraire l'extension de l'image
             $extension = $request->file('image')->getClientOriginalExtension();
              // générer un nom unique pour l'image
             $filenameToStore = $fileName.'_'.time().'.'.$extension;
             // schema de stockage de l'image
             $path = $request->file('image')->storeAs('public/produits',$filenameToStore);
             // $file->move($path, $filename);
                 if ($produit->image != 'noimage.jpg') {
                     Storage::delete('public/produits/'.$produit->image);
                 }

                 $produit->image = $filenameToStore;
             }


         $produit->update([
             'nom' => $request->nom,
             'prix' => $request->prix,
             'category' => $request->category,
         ]);

         $notification = array(
             'message' => 'Produit a été modifié avec succès',
             'alert-type' => 'success'
         );


         return redirect()->route('equipements.all.equipement')->with($notification);
      }

     /**
      * Remove the specified resource from storage.
      */
     public function DeleteMateriel(string $id){
         //

             $produit = Materiel::findOrFail($id);
             if ($produit->image != 'noimage.jpg') {
                 Storage::delete('public/produits/'.$produit->image);
             }

             $produit->delete();

             $notification = array(
                 'message' => 'Produit a été supprimé avec succès',
                 'alert-type' => 'success'
             );


             return redirect()->route('equipements.all.equipement')->with($notification);
            }



         public function activerProduit($id){
             //

                 $produit = Materiel::findOrFail($id);
                 $produit->status = 1;

                 $produit->update();

                 $notification = array(
                     'message' => 'Produit '. $produit->nom.' a été activé avec succès',
                     'alert-type' => 'success'
                 );


                 return redirect()->route('equipements.all.equipement')->with($notification);
                }

             public function desactiverProduit($id){
                 //

                     $produit = Materiel::findOrFail($id);
                     $produit->status = 0;

                     $produit->update();

                     $notification = array(
                         'message' => 'Produit '. $produit->nom. ' a été desactivé avec succès',
                         'alert-type' => 'success'
                     );


                     return redirect()->route('listeproduit')->with($notification);
                 }

}
