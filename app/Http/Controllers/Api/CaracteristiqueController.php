<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Caracteristique;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CaracteristiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Caracteristique::all();
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
            'nom' => ['required', Rule::in(['eau', 'lumière', 'difficulté'])],
            'valeur' => 'required | digits_between:1,5',
            'plante_id' => 'exists:plantes,id',
        ]);

        $caracteristique = Caracteristique::create($data);

        return $caracteristique;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Caracteristique  $caracteristique
     * @return \Illuminate\Http\Response
     */
    public function show(Caracteristique $caracteristique)
    {
        return $caracteristique;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Caracteristique  $caracteristique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caracteristique $caracteristique)
    {
        $data = $this->validate($request, [
            'nom' => ['required', Rule::in(['eau', 'lumière', 'difficulté'])],
            'valeur' => 'required | digits_between:1,5',
            'plante_id' => 'exists:plantes,id',
        ]);

        $caracteristique->fill($data);
        $caracteristique->save();

        return $caracteristique;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Caracteristique  $caracteristique
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caracteristique $caracteristique)
    {
        $caracteristique->delete();
        return response()->json(true);
    }
}
