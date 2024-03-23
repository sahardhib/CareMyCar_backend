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
        $myVisits = VisitModel::whereHas('voiture', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->get();
        return $myVisits;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $visit = VisitModel::create([
                'voiture_id' => $request->voiture_id,
                'date' => $request->date,
                'status' => $request->status,
                'mileage' => $request->mileage,
            ]);


            return response()->json([
                'message' => "Rendez-vous ajouté avec succès",
                'visit' => $visit,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Une erreur s'est produite!"
            ], 500);
        }
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
