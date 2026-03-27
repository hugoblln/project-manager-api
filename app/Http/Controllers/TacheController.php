<?php

namespace App\Http\Controllers;

use App\Http\Requests\TachesStoreRequest;
use App\Http\Requests\TachesUpdateRequest;
use App\Http\Resources\TacheResource;
use App\Models\Tache;


class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taches = Tache::all();

        return TacheResource::collection($taches);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TachesStoreRequest $request)
    {
        $validatedData = $request->validated();

       $tache = $request->user()->taches()->create($validatedData);

        return response()->json([
        'message' => 'Tache créee avec succès',
        'tache' => new TacheResource($tache)
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tache $tache)
    {
        return new TacheResource($tache);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TachesUpdateRequest $request, Tache $tache)
    {
        $validatedData = $request->validated();
        
        $tache->update($validatedData);

        return response()->json([
            'message' => 'Tache mise à jour avec succès',
            'tache' => new TacheResource($tache)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tache $tache)
    {
        $tache->delete();

        return response()->json([
            'message' => 'Tache supprimée avec succès',
        ], 200);
    }
}
