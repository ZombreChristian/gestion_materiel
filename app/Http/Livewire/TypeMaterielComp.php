<?php

namespace App\Http\Livewire;

use App\Models\Proprietaire_materiel;
use App\Models\TypeMateriel;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TypeMaterielComp extends Component
{
    use WithPagination;

    public $search = "";
    public $isAddTypeMateriel = false;
    public $newTypeMaterielName = "";
    public $newPropModel = [];
    public $editPropModel = [];
    public $newValue = "";
    public $selectedTypeMateriel;

    protected $paginationTheme = "bootstrap";

    public function render()
    {

        Carbon::setLocale("fr");

        $searchCriteria = "%".$this->search."%";

        $data = [
            "typesEquipements" => TypeMateriel::where("nom", "like", $searchCriteria)->latest()->paginate(5),
            "proprietesTypesEquipements" => Proprietaire_materiel::where("type_materiels_id", optional($this->selectedTypeMateriel)->id)->get()
        ];
        return view('livewire.typesEquipements.index', $data)
                ->extends("layouts.master")
                ->section("contenu");
    }

    public function toggleShowAddTypeMaterielForm(){
         if($this->isAddTypeMateriel){
            $this->isAddTypeMateriel = false;
            $this->newTypeMaterielName = "";
            $this->resetErrorBag(["newTypeMaterielName"]);
         }else{
            $this->isAddTypeMateriel = true;
         }
    }

    public function addNewTypeMateriel(){
        $validated = $this->validate([
            "newTypeMaterielName" => "required|max:50|unique:type_materiels,nom"
        ]);

        TypeMateriel::create(["nom"=> $validated["newTypeMaterielName"]]);

        $this->toggleShowAddTypeMaterielForm();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type d'article ajouté à jour avec succès!"]);

    }

    public function editTypeMateriel(TypeMateriel $typeMateriel){
        $this->dispatchBrowserEvent("showEditForm", ["typeMateriel" => $typeMateriel]);
    }

    public function updateTypeMateriel(TypeMateriel $typeMateriel, $valueFromJS){
        $this->newValue = $valueFromJS;
        $validated = $this->validate([
            "newValue" => ["required", "max:50", Rule::unique("type_materiels", "nom")->ignore($typeMateriel->id)]
        ]);

        $typeMateriel->update(["nom"=> $validated["newValue"]]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type d'article mis à jour avec succès!"]);

    }

    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de supprimer $name de la liste des types d'articles. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "type_article_id" => $id
            ]
        ]]);
    }

    public function deleteTypeMateriel(TypeMateriel $typeMateriel){
        $typeMateriel->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type d'article supprimé avec succès!"]);
    }

    public function showProp(TypeMateriel $typeMateriel){

        $this->selectedTypeMateriel = $typeMateriel;

        $this->dispatchBrowserEvent("showModal", []);


    }

    public function addProp(){
        $validated = $this->validate([
            "newPropModel.nom" => [
                "required",
                Rule::unique("propriete_articles", "nom")->where("type_article_id", $this->selectedTypeMateriel->id)
            ],
            "newPropModel.estObligatoire" => "required"
        ]);

        Proprietaire_materiel::create([
            "nom" => $this->newPropModel["nom"],
            "estObligatoire" => $this->newPropModel["estObligatoire"],
            "type_article_id" => $this->selectedTypeMateriel->id,
        ]);

        $this->newPropModel = [];
        $this->resetErrorBag();

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Propriété ajoutée avec succès!"]);
    }

    function showDeletePrompt($name , $id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de supprimer '$name' de la liste des propriétés d'articles. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "propriete_id" => $id
            ]
        ]]);
    }

    public function deleteProp(Proprietaire_materiel $proprietaire_materiel){

        $proprietaire_materiel->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Propriété supprimée avec succès!"]);
    }

    public function editProp(Proprietaire_materiel $proprietaire_materiel){

        $this->editPropModel["nom"] = $proprietaire_materiel->nom;
        $this->editPropModel["estObligatoire"] = $proprietaire_materiel->estObligatoire;
        $this->editPropModel["id"] = $proprietaire_materiel->id;

        $this->dispatchBrowserEvent("showEditModal", []);
    }

    public function updateProp(){
        $this->validate([
            "editPropModel.nom" => [
                "required",
                Rule::unique("propriete_articles", "nom")->ignore($this->editPropModel["id"])
            ],
            "editPropModel.estObligatoire" => "required"
        ]);

        Proprietaire_materiel::find($this->editPropModel["id"])->update([
            "nom" => $this->editPropModel["nom"],
            "estObligatoire" => $this->editPropModel["estObligatoire"]
        ]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Propriété mise à jour avec succès!"]);
        $this->closeEditModal();
    }

    public function closeModal(){
        $this->dispatchBrowserEvent("closeModal", []);
    }

    public function closeEditModal(){
        $this->editPropModel = [];
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeEditModal", []);
    }



}