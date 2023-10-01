<?php

use App\Models\Atelier;
use App\Models\Fonction;





use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\NoteController;

use App\Http\Controllers\Api\ZoneController;

use App\Http\Controllers\Api\EleveController;

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PosteController;


use App\Http\Controllers\Api\SalleController;


use App\Http\Controllers\Api\TacheController;


use App\Http\Controllers\Api\CachetController;
use App\Http\Controllers\Api\ClasseController;
use App\Http\Controllers\Api\GroupeController;
use App\Http\Controllers\Api\AtelierController;
use App\Http\Controllers\Api\CantineController;
use App\Http\Controllers\Api\MatiereController;
use App\Http\Controllers\Api\PeriodeController;
use App\Http\Controllers\Api\ProduitController;
use App\Http\Controllers\Api\TrancheController;
use App\Http\Controllers\Api\BulletinController;
use App\Http\Controllers\Api\ControleController;
use App\Http\Controllers\Api\FonctionController;
use App\Http\Controllers\Api\PaiementController;
use App\Http\Controllers\Api\PersonneController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\BlocSalleController;
use App\Http\Controllers\Api\ClubEleveController;
use App\Http\Controllers\Api\InfirmierController;
use App\Http\Controllers\Api\MoratoireController;
use App\Http\Controllers\Api\ResultatsController;
use App\Http\Controllers\Api\SalleBaseController;
use App\Http\Controllers\Api\SequencesController;
use App\Http\Controllers\Api\SignatureController;
use App\Http\Controllers\Api\TrimestreController;
use App\Http\Controllers\Api\EnseignantController;
use App\Http\Controllers\Api\FichesanteController;
use App\Http\Controllers\Api\FournitureController;
use App\Http\Controllers\Api\InfirmerieController;
use App\Http\Controllers\Api\PosteEleveController;
use App\Http\Controllers\Api\RessourcesController;
use App\Http\Controllers\Api\CahierAppelController;
use App\Http\Controllers\Api\EmploiTempsController;
use App\Http\Controllers\Api\JourPeriodeController;
use App\Http\Controllers\Api\NiveauAccesController;
use App\Http\Controllers\Api\NombreJoursController;
use App\Http\Controllers\Api\SalleClasseController;
use App\Http\Controllers\Api\BullSequenceController;
use App\Http\Controllers\Api\ClasseSystemController;
use App\Http\Controllers\Api\TypePaiementController;
use App\Http\Controllers\Api\EtablissementController;
use App\Http\Controllers\Api\MatiereSystemController;
use App\Http\Controllers\Api\ComplexSportifController;
use App\Http\Controllers\Api\InsolvabiliterController;
use App\Http\Controllers\Api\ProgrammeSalleController;
use App\Http\Controllers\Api\TypeEnseignantController;
use App\Http\Controllers\Api\AnneeAcademiqueController;
use App\Http\Controllers\Api\LivresProgrammeController;
use App\Http\Controllers\Api\ResultTrimestreController;
use App\Http\Controllers\Api\EvenementSportifController;
use App\Http\Controllers\Api\ProgrammeMatiereController;
use App\Http\Controllers\Api\TypeEnseignementController;
use App\Http\Controllers\Api\BilletEntrerSortiController;
use App\Http\Controllers\Api\CycleEnseignementController;
use App\Http\Controllers\Api\FichediciplinaireController;
use App\Http\Controllers\Api\FichePresenceJoursController;
use App\Http\Controllers\Api\MaterieldidactiqueController;
use App\Http\Controllers\Api\MatiersysClassesysController;
use App\Http\Controllers\Api\NiveauEnseignementController;
use App\Http\Controllers\Api\ResponsableAtelierController;
use App\Http\Controllers\Api\ResponsableComplexController;
use App\Http\Controllers\Api\EtablissementNiveauController;
use App\Http\Controllers\Api\SecteurEnseignementController;
use App\Http\Controllers\Api\AdmincirconscriptionController;
use App\Http\Controllers\ProgrammesemaineController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Route Api pour les infirmeries
Route::apiResource('infirmerie', InfirmerieController::class);

// Route api pour authentification
Route::post("login", [LoginController::class, "login"])->name('login');
Route::prefix("circonscription")->middleware('circoncription:admins_circonscription')->group(function () {
    Route::post("chefetablissement", [AdmincirconscriptionController::class, "chefEtablissement"]);
    Route::get("allchefetablissement", [AdmincirconscriptionController::class, "list"]);
    Route::get("etablissements", [AdmincirconscriptionController::class, "alletablissement"]);
    Route::post('/alletablissements_base', [EtablissementController::class, 'store']);
    Route::get('showEtablissement', [AdmincirconscriptionController::class, 'showEtablissement']); 
});

Route::prefix("superadmin")->middleware('superadmin:superadmin')->group(function () {
    // Route de l'api pour créer un admin de circonscription
    Route::post("admincirconscriptions/create", [AdmincirconscriptionController::class, "store"]);
    Route::put("admincirconscriptions/update/{id}", [AdmincirconscriptionController::class, "update"]);
    Route::get("admincirconscriptions/list", [AdmincirconscriptionController::class, "index"]);
    Route::get("admincirconscriptions/show/{id}", [AdmincirconscriptionController::class, "show"]);
    Route::delete("admincirconscriptions/destroy/{id}", [AdmincirconscriptionController::class, "destroy"]);
});

Route::post('bulletinsequence', [BulletinController::class, 'sequence']);
Route::post('bulletintrimestre', [BulletinController::class, 'trimestre']);
Route::post('bulletinannuel', [BulletinController::class, 'annuel']);
Route::post('resultaannuel',[ResultatsController::class, 'annuel']);
Route::post('resultatrimestre',[ResultatsController::class, 'trimestre']);
Route::post('resultasequence', [ResultatsController::class, 'sequence']);
Route::post("notes", [NoteController::class, "store"]);
// Route des Api pour les cantines
// remplacer les cantines par les comercants
Route::prefix("cantines")->group(function () {
    Route::get("/allcantines", [CantineController::class, "index"]);
    Route::get("/allcantines/{cantine}", [CantineController::class, "show"]);
    Route::post("/allcantines", [CantineController::class, "store"]);
    Route::put("/allcantines/update/{cantine}", [CantineController::class, "update"]);
    Route::delete("/allcantines/delete/{cantine}", [CantineController::class, "delete"]);
    // Route Api lier aux cantines et aux produits
    Route::post('/allcantines/{cantine}/produit', [ProduitController::class, "storeproduct"]);
    Route::get('/allcantines/{cantine}/allproduit', [ProduitController::class, "showallproduct"]);
    Route::post('/allcantines/{cantine}/allproduit/update/{produit}', [ProduitController::class, "updateUniqueProduct"]);
    Route::get('/allcantines/{cantine}/allproduit/detache/{produit}', [ProduitController::class, "removeUniqueProduct"]);
});
// route Api pour les infirmiers d'une infirmerie

// Route des Api pour les produits
Route::get('/allproduits', [ProduitController::class, "index"]);

// protection des routes chef etablissement
Route::prefix('chefetablissement')->middleware('chefetablissement:chef_etablissement')->group(function () {
    Route::get('/alletablissements_base', [EtablissementController::class, 'index']);
});
// Route des Api pour les etablissements
Route::prefix('etablissements_base')->group(function () {
    Route::get('/alletablissements_base/{etablissement}', [EtablissementController::class, 'show']);
    Route::put('/alletablissements_base/update/{etablissement}', [EtablissementController::class, 'update']);
    Route::delete('/alletablissements_base/delete/{etablissement}', [EtablissementController::class, 'delete']);

    // route Api pour les etablissements et les eleves
    Route::get('/alletablissements_base/{etablissement}/eleves', [EleveController::class, 'showStudent']);
    Route::get('/alletablissements_base/{etablissement}/eleves/detache/{eleve}', [EleveController::class, 'removeUniqueStudent']);
    Route::post('/alletablissements_base/{etablissement}/eleves', [EleveController::class, 'addStudent']);
    Route::post('/alletablissements_base/{etablissement}/eleves/update/{eleve}', [EleveController::class, 'updateStudent']);
});
// route api pour les poste
Route::prefix('poste')->group(function () {
    Route::get('/allpostes', [PosteController::class, 'index']);
    Route::get('/allpostes/{poste}', [PosteController::class, 'show']);
    Route::post('/allpostes', [PosteController::class, 'store']);
    Route::put('/allpostes/update/{poste}', [PosteController::class, 'update']);
    Route::delete('/allpostes/delete/{poste}', [PosteController::class, 'destroy']);


    Route::prefix('poste_salledeclasse')->group(function () {
    Route::get('/Poste/view/{id}', [PosteController::class, 'createAssign']);
    Route::get('/Poste/detach-Poste/{id}', [PosteController::class, 'createDetach']);
    Route::post('/Poste/assign-Poste-store', [PosteController::class, 'storeAssign']);
    Route::post('/detach-Poste-store', [PosteController::class, 'storeDetach']);
    });
});

// route Api pour les cahets
Route::prefix('cachets')->group(function () {
    Route::get('/allcachets', [CachetController::class, 'index']);
    Route::get('{etablissement}/allcachets', [CachetController::class, 'onlycachet']);
    Route::get('/allcachets/{cachet}', [CachetController::class, 'show']);
    Route::post('/allcachets', [CachetController::class, 'storeCachet']);
    Route::put('/allcachets/update/{cachet}', [CachetController::class, 'updatecachet']);
    Route::delete('/allcachets/delete/{cachet}', [CachetController::class, 'deletecachet']);
});
// route api pour les signatures
Route::prefix('signatures')->group(function () {
    Route::get('/allsignatures', [SignatureController::class, 'index']);
    Route::get('{etablissement}/allsignatures', [SignatureController::class, 'onlysignature']);
    Route::get('/allsignatures/{signature}', [SignatureController::class, 'show']);
    Route::post('/allsignatures', [SignatureController::class, 'storesignature']);
    Route::put('/allsignatures/update/{signature}', [SignatureController::class, 'updatesignature']);
    Route::delete('/allsignatures/delete/{signature}', [SignatureController::class, 'deletesignature']);
});


// route Api pour les fiches disciplinaires des eleves
Route::prefix('fichedisciplinaires')->group(function () {
    Route::post('/fiche', [FichediciplinaireController::class, 'addfiche']);
    Route::get('/fiche/{eleve}', [FichediciplinaireController::class, 'showfiche']);
    Route::put('/fiche/update/{fichediciplinaire}', [FichediciplinaireController::class, 'updatefiche']);
    Route::delete('/fiche/delete/{fichediciplinaire}', [FichediciplinaireController::class, 'destroyfiche']);
    Route::post('/alletablissements/assign-etablissements-store/{etablissement}', [EtablissementController::class, 'storeAssign']);
    Route::post('/alletablissements/detach-etablissements-store/{etablissement}', [EtablissementController::class, 'storeDetach']);
});
// route Api pour les matiere

Route::get('/allmatieres', [MatiereController::class, "index"]);
Route::get('{classe}/allmatieres', [MatiereController::class, "showMatiere"]);
Route::post('/allmatieres', [MatiereController::class, "addMatiere"]);
Route::put('/allmatieres/update/{matiere}', [MatiereController::class, "updateMatiere"]);
Route::delete('/allmatieres/delete/{matiere}', [MatiereController::class, "deleteMatiere"]);

// Gerer les blocs de salle
Route::get('blocsalle/list-bloc', [BlocSalleController::class, 'index']);
Route::post('blocsalle/create', [BlocSalleController::class, 'store']);
Route::get('blocsalle/show/{id}', [BlocSalleController::class, 'show']);
Route::put('blocsalle/update/{id}', [BlocSalleController::class, 'update']);
Route::delete('blocsalle/delete/{id}', [BlocSalleController::class, 'destroy']);

// Gerer les matieres du systeme
Route::get('matieresysteme/list', [MatiereSystemController::class, 'index']);
Route::post('matieresysteme/create', [MatiereSystemController::class, 'store']);
Route::get('matieresysteme/show/{id}', [MatiereSystemController::class, 'show']);
Route::put('matieresysteme/update/{id}', [MatiereSystemController::class, 'update']);
Route::delete('matieresysteme/delete/{id}', [MatiereSystemController::class, 'destroy']);

// Gerer les complex sportifs
Route::get('complexsportif/list-complex', [ComplexSportifController::class, 'index']);
Route::post('complexsportif/create', [ComplexSportifController::class, 'store']);
Route::get('complexsportif/show/{id}', [ComplexSportifController::class, 'show']);
Route::put('complexsportif/update/{id}', [ComplexSportifController::class, 'update']);
Route::delete('complexsportif/delete/{id}', [ComplexSportifController::class, 'destroy']);

// Gerer les evenements sportifs
Route::get('evenementsportif/list-evenement', [EvenementSportifController::class, 'index']);
Route::post('evenementsportif/create', [EvenementSportifController::class, 'store']);
Route::get('evenementsportif/show/{id}', [EvenementSportifController::class, 'show']);
Route::put('evenementsportif/update/{id}', [EvenementSportifController::class, 'update']);
Route::delete('evenementsportif/delete/{id}', [EvenementSportifController::class, 'destroy']);
//evenement d'un complex sportif
Route::get('evenementsportif/{id}/complexsportif', [EvenementSportifController::class, 'evenement']);

// Gerer les controles
Route::get('controle/list-controle', [ControleController::class, 'index']);
Route::post('controle/create', [ControleController::class, 'store']);
Route::get('controle/show/{id}', [ControleController::class, 'show']);
Route::put('controle/update/{id}', [ControleController::class, 'update']);
Route::delete('controle/delete/{id}', [ControleController::class, 'destroy']);
//controles d'une sequence
Route::get('controle/{id}/sequence', [ControleController::class, 'controle']);

//Gerer fiche presence jours
Route::get('fichepresencejour/list-fiche', [FichePresenceJoursController::class, 'index']);
Route::post('fichepresencejour/create', [FichePresenceJoursController::class, 'store']);
Route::get('fichepresencejour/show/{id}', [FichePresenceJoursController::class, 'show']);
Route::put('fichepresencejour/update/{id}', [FichePresenceJoursController::class, 'update']);
Route::delete('fichepresencejour/delete/{id}', [FichePresenceJoursController::class, 'destroy']);
//fiche de presence d'une salle
Route::get('fichepresencejour/{id}/salle', [FichePresenceJoursController::class, 'fichesalle']);

//Gerer les jours
Route::get('jour/list-jours', [NombreJoursController::class, 'index']);
Route::post('jour/create', [NombreJoursController::class, 'store']);
Route::get('jour/show/{id}', [NombreJoursController::class, 'show']);
Route::put('jour/update/{id}', [NombreJoursController::class, 'update']);
Route::delete('jour/delete/{id}', [NombreJoursController::class, 'destroy']);
// jours d'un établissement
//Route::get('jour/{id}/etablissement', [NombreJoursController::class, 'fichesalle']);



//Gerer les club d'eleve
Route::get('club/list-club', [ClubEleveController::class, 'index']);
Route::post('club/create', [ClubEleveController::class, 'store']);
Route::get('club/show/{id}', [ClubEleveController::class, 'show']);
Route::put('club/update/{id}', [ClubEleveController::class, 'update']);
Route::delete('club/delete/{id}', [ClubEleveController::class, 'destroy']);
//moratoire d'une tranche
Route::get('club/etablissement/{id}', [ClubEleveController::class, 'clubeleve']);

//Gerer les ateliers
Route::get('atelier/list-atelier', [AtelierController::class, 'index']);
Route::post('atelier/create', [AtelierController::class, 'store']);
Route::get('atelier/show/{id}', [AtelierController::class, 'show']);
Route::put('atelier/update/{id}', [AtelierController::class, 'update']);
Route::delete('atelier/delete/{id}', [AtelierController::class, 'destroy']);

//Gerer les responsables ateliers
Route::get('responsable/atelier/list-atelier', [ResponsableAtelierController::class, 'index']);
Route::post('responsable/atelier/create', [ResponsableAtelierController::class, 'store']);
Route::get('responsable/atelier/show/{id}', [ResponsableAtelierController::class, 'show']);
Route::put('responsable/atelier/update/{id}', [ResponsableAtelierController::class, 'update']);
Route::delete('responsable/atelier/delete/{id}', [ResponsableAtelierController::class, 'destroy']);

//Gerer les responsables de complex sportifs
Route::get('responsable/complexesportif/list-complex', [ResponsableComplexController::class, 'index']);
Route::post('responsable/complexesportif/create', [ResponsableComplexController::class, 'store']);
Route::get('responsable/complexesportif/show/{id}', [ResponsableComplexController::class, 'show']);
Route::put('responsable/complexesportif/update/{id}', [ResponsableComplexController::class, 'update']);
Route::delete('responsable/complexesportif/delete/{id}', [ResponsableComplexController::class, 'destroy']);

//Gerer les niveaux d'enseignement
Route::get('niveau/list-niveau', [NiveauEnseignementController::class, 'index']);
Route::post('niveau/create', [NiveauEnseignementController::class, 'store']);
Route::get('niveau/show/{id}', [NiveauEnseignementController::class, 'show']);
Route::put('niveau/update/{id}', [NiveauEnseignementController::class, 'update']);
Route::delete('niveau/delete/{id}', [NiveauEnseignementController::class, 'destroy']);

//Gerer les eleves d'une classe pour le cahier d'appelle
Route::get('salleeleve/list/{id}', [CahierAppelController::class, 'selecteleve']);

//Gerer les etablissement et leur niveau d'enseignement
Route::get('etablissementniveau/list-niveau', [EtablissementNiveauController::class, 'index']);
Route::post('etablissementniveau/create', [EtablissementNiveauController::class, 'store']);
Route::get('etablissementniveau/show/{id}', [EtablissementNiveauController::class, 'show']);
Route::put('etablissementniveau/update/{id}', [EtablissementNiveauController::class, 'update']);
Route::delete('etablissementniveau/delete/{id}', [EtablissementNiveauController::class, 'destroy']);
Route::post('etablissementniveau/atache', [EtablissementNiveauController::class, 'createatache']);

// gerer les jour et leur periodes
Route::get('Jourandperiode/list', [JourPeriodeController::class, 'index']);
Route::post('Jourandperiode/attach', [JourPeriodeController::class, 'store']);
Route::get('Jourandperiode/show/{id}', [JourPeriodeController::class, 'show']);
Route::post('Jourandperiode/detache/{id}', [JourPeriodeController::class, 'detacherjour']);

//Gerer l'emploi de temps de l'établissement
Route::get('Jourandperiode/selectperiode', [JourPeriodeController::class, 'selectperiode']);
Route::get('Jourandperiode/selectjours', [JourPeriodeController::class, 'selectjours']);

//Gerer les années académique
Route::get('annee/list-annee', [AnneeAcademiqueController::class, 'index']);
Route::post('annee/create', [AnneeAcademiqueController::class, 'store']);
Route::get('annee/show/{id}', [AnneeAcademiqueController::class, 'show']);
Route::put('annee/update/{id}', [AnneeAcademiqueController::class, 'update']);
Route::delete('annee/delete/{id}', [AnneeAcademiqueController::class, 'destroy']);

//Gerer les type d'enseignements
Route::get('typeenseignemt/list', [TypeEnseignementController::class, 'index']);
Route::post('typeenseignemt/create', [TypeEnseignementController::class, 'store']);
Route::get('typeenseignemt/show/{id}', [TypeEnseignementController::class, 'show']);
Route::put('typeenseignemt/update/{id}', [TypeEnseignementController::class, 'update']);
Route::delete('typeenseignemt/delete/{id}', [TypeEnseignementController::class, 'destroy']);

//Gerer les cycles d'enseignements
Route::get('cycleenseignemt/list', [CycleEnseignementController::class, 'index']);
Route::post('cycleenseignemt/create', [CycleEnseignementController::class, 'store']);
Route::get('cycleenseignemt/show/{id}', [CycleEnseignementController::class, 'show']);
Route::put('cycleenseignemt/update/{id}', [CycleEnseignementController::class, 'update']);
Route::delete('cycleenseignemt/delete/{id}', [CycleEnseignementController::class, 'destroy']);

//Gerer l'emploi de temps
Route::get('emploi/list/{id}', [EmploiTempsController::class, 'index']);
Route::post('emploi/create', [EmploiTempsController::class, 'store']);
Route::put('emploi/update/{id}', [EmploiTempsController::class, 'update']);

//Gerer les fournitures
Route::get('fourniture/list-fourniture', [FournitureController::class, 'index']);
Route::post('fourniture/create', [FournitureController::class, 'store']);
Route::get('fourniture/show/{id}', [FournitureController::class, 'show']);
Route::put('fourniture/update/{id}', [FournitureController::class, 'update']);
Route::delete('fourniture/delete/{id}', [FournitureController::class, 'destroy']);

// Gerer salle d'un etablissement
Route::get('sallebase/list-salle', [SalleBaseController::class, 'index']);
Route::post('sallebase/create', [SalleBaseController::class, 'store']);
Route::get('sallebase/show/{id}', [SalleBaseController::class, 'show']);
Route::put('sallebase/update/{id}', [SalleBaseController::class, 'update']);
Route::delete('sallebase/delete/{id}', [SalleBaseController::class, 'destroy']);
//salle d'un etablissement
Route::get('sallebase/{id}/etablissement', [SalleBaseController::class, 'sallesetablis']);

// Gerer les ressources
Route::get('ressource/list-ressource', [RessourcesController::class, 'index']);
Route::post('ressource/create', [RessourcesController::class, 'store']);
Route::get('ressource/show/{id}', [RessourcesController::class, 'show']);
Route::put('ressource/update/{id}', [RessourcesController::class, 'update']);
Route::delete('ressource/delete/{id}', [RessourcesController::class, 'destroy']);
// liaison entre les ressources et les ateliers
Route::get('atelier/{id}/ressource', [RessourcesController::class, 'ressource']);
// Route::get('atelier/{atelier}/ressource/detache/{ressource}', [RessourcesController::class, "detacheressources"]);

// Gerer les programmes salles
Route::get('programmesalle/list-programme', [ProgrammeSalleController::class, 'index']);
Route::post('programmesalle/create', [ProgrammeSalleController::class, 'store']);
Route::get('programmesalle/show/{id}', [ProgrammeSalleController::class, 'show']);
Route::put('programmesalle/update/{id}', [ProgrammeSalleController::class, 'update']);
Route::delete('programmesalle/delete/{id}', [ProgrammeSalleController::class, 'destroy']);
// liaison entre les et les ateliers
Route::get('salle/{id}/programmesalle', [ProgrammeSalleController::class, 'liste']);

// Gerer les programmes de matiere
Route::get('programmematiere/list', [ProgrammeMatiereController::class, 'index']);
Route::post('programmematiere/create', [ProgrammeMatiereController::class, 'store']);
Route::get('programmematiere/show/{id}', [ProgrammeMatiereController::class, 'show']);
Route::put('programmematiere/update/{id}', [ProgrammeMatiereController::class, 'update']);
Route::delete('programmematiere/delete/{id}', [ProgrammeMatiereController::class, 'destroy']);
Route::post('prgMatiere/assign-CahierTexte-store', [ProgrammeMatiereController::class, 'storeAssign']);
Route::post('detach-prgMatiere-store-CahierTexte', [ProgrammeMatiereController::class, 'storeDetach']);

// Gerer les salles de classes
Route::get('salleclasse/list-salle', [SalleClasseController::class, 'index']);
Route::post('salleclasse/create', [SalleClasseController::class, 'store']);
Route::get('salleclasse/show/{id}', [SalleClasseController::class, 'show']);
Route::put('salleclasse/update/{id}', [SalleClasseController::class, 'update']);
Route::delete('salleclasse/delete/{id}', [SalleClasseController::class, 'destroy']);
// liaison entre les classes et les salles
Route::get('classe/{id}/salleclasse', [SalleClasseController::class, 'salleclasses']);

// Route Api pour le materiel didactique
Route::prefix('materieldidactiques')->group(function () {
    Route::get('/allmaterieldidactiques', [MaterieldidactiqueController::class, 'index']);
    Route::get('/allmaterieldidactiques/{materieldidactique}', [MaterieldidactiqueController::class, 'show']);
    Route::post('/allmaterieldidactiques', [MaterieldidactiqueController::class, 'store']);
    Route::put('/allmaterieldidactiques/update/{materieldidactique}', [MaterieldidactiqueController::class, 'update']);
    Route::delete('/allmaterieldidactiques/delete/{materieldidactique}', [MaterieldidactiqueController::class, 'destroy']);
});

// Route Api pour les fiches santes
// Route Api pour les fiches santes
Route::prefix('fichesanter')->group(function () {
    Route::get('/allfichesanter', [FichesanteController::class, 'index']);
    Route::get('/allfichesanter/{fichesanter}', [FichesanteController::class, 'show']);
    Route::post('/allfichesanter', [FichesanteController::class, 'store']);
    Route::delete('/allfichesanter/delete/{fichesanter}', [FichesanteController::class, 'destroy']);
    Route::put('/allfichesanter/update/{fichesanter}', [FichesanteController::class, 'update']);
});
Route::prefix('infirmier')->group(function () {
    Route::get('/allinfirmier', [InfirmierController::class, 'index']);
    Route::get('/allinfirmier/{infirmier}', [InfirmierController::class, 'show']);
    Route::get('{infirmerie}/allinfirmier', [InfirmierController::class, 'showall']);
    Route::post('/allinfirmier', [InfirmierController::class, 'store']);
    Route::delete('/allinfirmier/delete/{infirmier}', [InfirmierController::class, 'destroy']);
    Route::put('/allinfirmier/update/{infirmier}', [InfirmierController::class, 'update']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Crud des Api Du Bus


Route::post('bus', [BusController::class, 'store']);
Route::get('bus', [BusController::class, 'index']);
Route::get('bus/{id}', [BusController::class, 'show']);
Route::put('bus/{id}', [BusController::class, 'update']);
Route::delete('bus/{id}', [BusController::class, 'destroy']);

Route::get('/bus/view/{id}', [BusController::class, 'createAssign']);
Route::get('/bus/detach-bus/{id}', [BusController::class, 'createDetach']);
Route::post('/bus/assign-bus-store', [BusController::class, 'storeAssign']);
Route::post('/detach-bus-store', [BusController::class, 'storeDetach']);



// Crud Des Api De la Classe de l'etablissement

Route::post('classes', [ClasseController::class, 'store']);
Route::get('classes', [ClasseController::class, 'index']);
Route::get('classes/{id}', [ClasseController::class, 'show']);
Route::put('classes/{id}', [ClasseController::class, 'update']);
Route::delete('classes/{id}', [ClasseController::class, 'destroy']);

// Gerer les classes du systeme
Route::get('classesystm/list', [ClasseSystemController::class, 'index']);
Route::post('classesystm/create', [ClasseSystemController::class, 'store']);
Route::get('classesystm/show/{id}', [ClasseSystemController::class, 'show']);
Route::put('classesystm/update/{id}', [ClasseSystemController::class, 'update']);
Route::delete('classesystm/delete/{id}', [ClasseSystemController::class, 'destroy']);

// Gerer les matieres d'une classe du system
Route::get('Matiereclasse/list', [MatiersysClassesysController::class, 'index']);
Route::post('Matiereclasse/attach', [MatiersysClassesysController::class, 'store']);
Route::get('Matiereclasse/show/{id}', [MatiersysClassesysController::class, 'show']);
Route::post('Matiereclasse/detache/{id}', [MatiersysClassesysController::class, 'detachermatiere']);

Route::prefix('classe_livres Programme')->group(function () {

    Route::post('/classe/assign-classe-store/{livres}', [ClasseController::class, 'storeAssign']);
    Route::post('/detach-classe-store/{livres}', [ClasseController::class, 'storeDetach']);
});




Route::post('zones/create', [ZoneController::class, 'store']);
Route::get('zones', [ZoneController::class, 'index']);
Route::get('zones/{zone}', [ZoneController::class, 'show']);
Route::put('zones/edit/{zone}', [ZoneController::class, 'update']);
Route::delete('zones/{zone}', [ZoneController::class, 'delete']);

Route::prefix('Zones_bus')->group(function () {

    Route::get('/zone/view/{bus}', [ZoneController::class, 'createAssign']);
    Route::get('/zone/detach-zone/{id}', [ZoneController::class, 'createDetach']);
    Route::post('/zone/assign-zone-store', [ZoneController::class, 'storeAssign']);
    Route::post('/detach-zone-store', [ZoneController::class, 'storeDetach']);
});

// Gestion des Trimestres
Route::post('trimestres/create', [TrimestreController::class, 'store']);
Route::get('trimestres', [TrimestreController::class, 'index']);
Route::get('trimestres/{id}', [TrimestreController::class, 'show']);
Route::put('trimestres/edit/{trimestre}', [TrimestreController::class, 'update']);
Route::delete('trimestres/delete/{id}', [TrimestreController::class, 'destroy']);

// Gestion des Sequences
Route::post('sequences/create', [SequencesController::class, 'store']);
Route::get('sequences', [SequencesController::class, 'index']);
Route::get('sequences/{id}', [SequencesController::class, 'show']);
Route::put('sequences/edit/{sequences}', [SequencesController::class, 'update']);
Route::delete('sequences/delete/{id}', [SequencesController::class, 'destroy']);




// Gestion des Livres au Programme
Route::post('livreprogrammes/create', [LivresProgrammeController::class, 'store']);
Route::get('livreprogrammes', [LivresProgrammeController::class, 'index']);
Route::get('livreprogrammes/{id}', [LivresProgrammeController::class, 'show']);
Route::put('livreprogrammes/edit/{livreprogrammes}', [LivresProgrammeController::class, 'update']);
Route::delete('livreprogrammes/delete/{id}', [LivresProgrammeController::class, 'delete']);



#routes
// gestions des Periodes

Route::post('periodes/create', [PeriodeController::class, 'store']);
Route::get('periodes', [PeriodeController::class, 'index']);
Route::get('periodes/{id}', [PeriodeController::class, 'show']);
Route::put('periodes/edit/{periodes}', [PeriodeController::class, 'update']);
Route::delete('periodes/delete/{id}', [PeriodeController::class, 'destroy']);

Route::prefix('moneygestions')->group(function () {
    Route::post('paiements/create', [PaiementController::class, 'store']);
    Route::get('paiements', [PaiementController::class, 'index']);
    Route::get('{eleve}/paiements', [PaiementController::class, 'showPaiment']);
    Route::get('paiements/{id}', [PaiementController::class, 'show']);
    Route::put('paiements/edit/{paiements}', [PaiementController::class, 'update']);
    Route::delete('paiements/delete/{id}', [PaiementController::class, 'destroy']);

    Route::get('/classe_paiements/view', [PaiementController::class, 'viewAttach']);
    Route::get('/allclasses/{classes}/paiements', [PaiementController::class, 'showClassePaiement']);
    Route::get('/paiements/view/{id}', [PaiementController::class, 'createAssign']);
    Route::get('/paiements/detach-paiements/{id}', [PaiementController::class, 'createDetach']);
    Route::post('/paiements/assign-paiements-store', [PaiementController::class, 'storeAssign']);
    Route::post('/detach-paiements-store', [PaiementController::class, 'storeDetach']);


    Route::get('/eleve_paiements/view', [PaiementController::class, 'viewAttachEleve']);
    Route::get('/eleve_paiements/view/{id}', [PaiementController::class, 'viewAssign']);
    Route::get('/eleve_paiements/detach-paiements/{id}', [PaiementController::class, 'viewDetach']);
    Route::post('/eleve_paiements/assign-paiements-store', [PaiementController::class, 'Assign']);
    Route::post('/detach-eleve_paiements-store', [PaiementController::class, 'Detach']);


    Route::post('Insolvabiliter/create', [InsolvabiliterController::class, 'store']);
    Route::get('Insolvabiliter', [InsolvabiliterController::class, 'index']);
    Route::get('{eleve}/Insolvabiliter', [InsolvabiliterController::class, 'showInsolve']);
    Route::get('Insolvabiliter/{id}', [InsolvabiliterController::class, 'show']);
    Route::put('Insolvabiliter/edit/{Insolvabiliter}', [InsolvabiliterController::class, 'update']);
    Route::delete('Insolvabiliter/delete/{id}', [InsolvabiliterController::class, 'destroy']);

    Route::post('typepaiements/create', [TypePaiementController::class, 'store']);
    Route::get('typepaiements', [TypePaiementController::class, 'index']);
    Route::get('typepaiements/{id}', [TypePaiementController::class, 'show']);
    Route::put('typepaiements/edit/{typepaiements}', [TypePaiementController::class, 'update']);
    Route::delete('typepaiements/delete/{id}', [TypePaiementController::class, 'delete']);

    Route::get('/typepaiement_paiements/view', [TypePaiementController::class, 'viewAttach']);
    Route::get('/typepaiements/view/{id}', [TypePaiementController::class, 'createAssign']);
    Route::get('/typepaiements/detach-typepaiements/{id}', [TypePaiementController::class, 'createDetach']);
    Route::post('/typepaiements/assign-typepaiements-store', [TypePaiementController::class, 'storeAssign']);
    Route::post('/detach-typepaiements-store', [TypePaiementController::class, 'storeDetach']);

    Route::post('tranches/create', [TrancheController::class, 'store']);
    Route::get('tranches', [TrancheController::class, 'index']);
    Route::get('tranches/{id}', [TrancheController::class, 'show']);
    Route::put('tranches/edit/{tranches}', [TrancheController::class, 'update']);
    Route::delete('tranches/delete/{id}', [TrancheController::class, 'delete']);


    //Gerer les moratoires
    Route::get('moratoire/list-moratoire', [MoratoireController::class, 'index']);
    Route::post('moratoire/create', [MoratoireController::class, 'store']);
    Route::get('moratoire/show/{id}', [MoratoireController::class, 'show']);
    Route::put('moratoire/update/{id}', [MoratoireController::class, 'update']);
    Route::delete('moratoire/delete/{id}', [MoratoireController::class, 'destroy']);
    //moratoire d'une tranche
    Route::get('moratoire/{id}/tranche', [MoratoireController::class, 'moratoire']);
});


Route::post('personnes/create', [PersonneController::class, 'store']);
Route::get('personnes', [PersonneController::class, 'index']);
Route::get('personnes/{id}', [PersonneController::class, 'show']);
Route::put('personnes/edit/{personnes}', [PersonneController::class, 'update']);
Route::delete('personnes/delete/{id}', [PersonneController::class, 'destroy']);

// gestion des fonctions
Route::post('fonction/create', [FonctionController::class, 'store']);
Route::get('fonction', [FonctionController::class, 'index']);
Route::get('fonction/{id}', [FonctionController::class, 'show']);
Route::put('fonction/edit/{fonction}', [FonctionController::class, 'update']);
Route::delete('fonction/delete/{Fonction}', [FonctionController::class, 'delete']);

//gestion des niveau d'acces

Route::post('niveau_d_acces/create', [NiveauAccesController::class, 'store']);
Route::get('niveau_d_acces', [NiveauAccesController::class, 'index']);
Route::get('niveau_d_acces/{id}', [NiveauAccesController::class, 'show']);
Route::put('niveau_d_acces/edit/{niveau_d_acces}', [NiveauAccesController::class, 'update']);
Route::delete('niveau_d_acces/delete/{id}', [NiveauAccesController::class, 'delete']);

// gestion des taches

Route::post('taches/create', [TacheController::class, 'store']);
Route::get('taches', [TacheController::class, 'index']);
Route::get('taches/{id}', [TacheController::class, 'show']);
Route::put('taches/edit/{taches}', [TacheController::class, 'update']);
Route::delete('taches/delete/{id}', [TacheController::class, 'delete']);


//Gerer les permission avec billet d'entrer et billet de sorti


Route::post('billet/create', [BilletEntrerSortiController::class, 'store']);
Route::get('billet', [BilletEntrerSortiController::class, 'index']);
Route::get('billet/{id}', [BilletEntrerSortiController::class, 'show']);
Route::put('billet/edit/{billet}', [BilletEntrerSortiController::class, 'update']);
Route::delete('billet/delete/{id}', [BilletEntrerSortiController::class, 'delete']);


Route::prefix('gestionEnseignants')->group(function () {

    Route::post('enseignants/create', [EnseignantController::class, 'store']);
    Route::get('enseignants', [EnseignantController::class, 'index']);
    Route::get('enseignants/{id}', [EnseignantController::class, 'show']);
    Route::put('enseignants/edit/{id}', [EnseignantController::class, 'update']);
    Route::delete('enseignants/delete/{id}', [EnseignantController::class, 'destroy']);

    Route::post('typeenseignant/create', [TypeEnseignantController::class, 'store']);
    Route::get('typeenseignant', [TypeEnseignantController::class, 'index']);
    Route::get('typeenseignant/{id}', [TypeEnseignantController::class, 'show']);
    Route::put('typeenseignant/edit/{typeenseignant}', [TypeEnseignantController::class, 'update']);
    Route::delete('typeenseignant/delete/{id}', [TypeEnseignantController::class, 'destroy']);
});


Route::post('secteurs/create', [SecteurEnseignementController::class, 'store']);
Route::get('secteurs', [SecteurEnseignementController::class, 'index']);
Route::get('secteurs/{id}', [SecteurEnseignementController::class, 'show']);
Route::put('secteurs/edit/{secteurs}', [SecteurEnseignementController::class, 'update']);
Route::delete('secteurs/delete/{id}', [SecteurEnseignementController::class, 'destroy']);

Route::post('groupe/create', [GroupeController::class, 'store']);
Route::get('groupe', [GroupeController::class, 'index']);
Route::get('groupe/{id}', [GroupeController::class, 'show']);
Route::put('groupe/edit/{id}', [GroupeController::class, 'update']);
Route::delete('groupe/delete/{id}', [GroupeController::class, 'destroy']);

Route::prefix('relation_groupe_eleves')->group(function () {
    Route::get('/eleves_groupes/view', [GroupeController::class, 'viewAttach']);
    Route::get('/groupe/attach_view-eleves/{id}', [GroupeController::class, 'createAssign']);
    Route::get('/groupe/detach-eleves/{id}', [GroupeController::class, 'createDetach']);
    Route::post('/groupe/assign-groupe-store', [GroupeController::class, 'storeAssign']);
    Route::post('/detach-groupe-store', [GroupeController::class, 'storeDetach']);
});



Route::post('PostEleve/create', [PosteEleveController::class, 'store']);
Route::post('PostEleve/{id}/salle_classe/assign', [PosteEleveController::class, 'storepostEleve']);
Route::get('PostEleve', [PosteEleveController::class, 'index']);
Route::get('PostEleve/{id}', [PosteEleveController::class, 'show']);
Route::put('PostEleve/edit/{id}', [PosteEleveController::class, 'update']);
Route::delete('PostEleve/delete/{id}', [PosteEleveController::class, 'destroy']);

//Gestion des etablissement de base
Route::prefix('etablissementSecondaire')->group(function () {
    Route::post('Ets/create', [EtablissementSecondaire::class, 'store']);
    Route::get('Ets', [EtablissementSecondaire::class, 'index']);
    Route::get('Ets/{id}', [EtablissementSecondaire::class, 'show']);
    Route::put('Ets/edit/{Ets}', [EtablissementSecondaire::class, 'update']);
    Route::delete('Ets/delete/{id}', [EtablissementSecondaire::class, 'delete']);
});


Route::prefix('AllProgrammeSemaine')->group(function () {
    Route::post('prgSemaine/create', [ProgrammesemaineController::class, 'store']);
    Route::get('prgSemaine', [ProgrammesemaineController::class, 'index']);
    Route::get('prgSemaine/{id}', [ProgrammesemaineController::class, 'show']);
    Route::put('prgSemaine/edit/{prgSemaine}', [ProgrammesemaineController::class, 'update']);
    Route::delete('prgSemaine/delete/{id}', [ProgrammesemaineController::class, 'delete']);
    Route::post('/prgSemaine/assign-CahierTexte-store', [ProgrammesemaineController::class, 'storeAssign']);
    Route::post('/detach-prgSemaine-store-CahierTexte', [ProgrammesemaineController::class, 'storeDetach']);
    Route::post('/prgSemaine/assign-Matieres-store', [ProgrammesemaineController::class, 'attachMatieres']);
    Route::post('/detach-prgSemaine-store-Matieres', [ProgrammesemaineController::class, 'moveMatieres']);
});
