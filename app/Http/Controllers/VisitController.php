<?php

namespace App\Http\Controllers;

use App\Models\VisitModel;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getMyVisits(string $id)
    {
        $dates = VisitModel::where('status', 1)->pluck('date')->toArray();

        $myVisits = VisitModel::with('voiture')->whereHas('voiture', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->with('voiture:matricule,id')->get();

        return response()->json([
            'visits' => $myVisits,
            'dates' => $dates,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $visit = VisitModel::create([
                'voiture_id' => $request->car_id,
                'date' => $request->date,
                'status' => 0,
                'mileage' => $request->mileage,
                'selected_services' => $request->selected_services, // Sauvegarde les services sélectionnés
            ]);

            return response()->json([
                'message' => "Rendez-vous ajouté avec succès",
                'visit' => $visit,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Une erreur s'est produite!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Récupérer la visite par son ID
            $visit = VisitModel::find($id);

            if (!$visit) {
                return response()->json([
                    'message' => 'La visite n\'existe pas'
                ], 404);
            }

            // Mettre à jour les propriétés de la visite avec les nouvelles valeurs
            $visit->update([
                'mileage' => $request->mileage,
                'date' => $request->date,
                'voiture_id' => $request->car_id,
                'selected_services' => $request->selected_services, // Met à jour les services sélectionnés
            ]);

            return response()->json([
                'message' => 'visit modifiée avec succès',
                'visit' => $visit,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Une erreur s'est produite!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $visit = VisitModel::find($id);
        if (!$visit) {
            return response()->json([
                'message' => 'Le visite n\'existe pas'
            ], 404);
        }
        $visit->delete();

        return response()->json([
            'message' => 'visite supprimée avec succès'
        ], 200);
    }
}


    
