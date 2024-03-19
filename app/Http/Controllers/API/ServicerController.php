<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use Illuminate\Http\Request;
use App\Models\Service;

class ServicerController extends Controller
{
    public function index(){
        $services = Service::all();

        return response()->json([
            'results'=> $services
        ],200);
    }

    public function store(ServiceStoreRequest $request)
    {
        try {

            Service::create([
                'nom' => $request->nom,
                'description' => $request->description,
            ]);

           
            return response()->json([
                'message' => "service ajouté avec succès",
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Une erreur s'est produite!"
            ], 500);
        }
    }


    public function show($id){
        $services = Service::find($id);
        if(!$services){
            return response()->json([
                'message'=>'service n/existe pas.'
            ],404);
                }

                return response()->json([
                    'services'=>$services
                ],200);
        }

        public function update(ServiceStoreRequest $request, $id)
    {
        try {
            $services = Service::find($id);

            if (!$services) {
                return response()->json([
                    'message' => 'Le service n\'existe pas'
                ], 404);
            }

                $services->nom = $request->nom;
                $services->description = $request->description;
                
                    $services->save();
            
                    return response()->json([
                        'message' => 'Service modifiée avec succès',
                    ], 200);
        

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Une erreur s'est produite!"
            ], 500);
        }
    }

    public function destroy($id)
    {
        $services = Service::find($id);
        if (!$services) {
            return response()->json([
                'message' => 'Le service n\'existe pas'
            ], 404);
        }
        $services->delete();

        return response()->json([
            'message' => 'Service supprimée avec succès'
        ], 200);

    }
    
}
