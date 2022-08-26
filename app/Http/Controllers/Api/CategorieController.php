<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Categorie::with('plantes')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'nom' => 'string | required',
            'plantes.*' => 'nullable | exists:plantes,id'
        ]);

        $categorie = Categorie::create($data);
        $categorie->plantes()->attach($data['plantes']);

        return $categorie;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        return $categorie::where('id', '=', $categorie->id)
            ->with('plantes')
            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
        $data = $this->validate($request, [
            'nom' => 'string | required',
            'plantes.*' => 'exists:plantes,id'
        ]);

        $categorie->fill($data);
        $categorie->save();
        $categorie->plantes()->attach($data['plantes']);

        return $categorie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return response()->json(true);
    }
}
