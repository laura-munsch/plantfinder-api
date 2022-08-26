<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plante;
use Illuminate\Http\Request;

class PlanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Plante::with(['caracteristiques', 'categories'])->get();
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
            'description' => 'string | nullable',
            'image' => 'url | required',
            'categories.*' => 'nullable | exists:categories,id'
        ]);

        $plante = Plante::create($data);
        if (array_key_exists('categories', $data)) {
            $plante->categories()->attach($data['categories']);
        }

        return $plante;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plante  $plante
     * @return \Illuminate\Http\Response
     */
    public function show(Plante $plante)
    {
        return $plante::where('id', "=", $plante->id)
            ->with(['caracteristiques', 'categories'])
            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plante  $plante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plante $plante)
    {
        $data = $this->validate($request, [
            'nom' => 'string | required',
            'description' => 'string | nullable',
            'image' => 'url | required',
            'categories.*' => 'nullable | exists:categories,id'
        ]);

        $plante->fill($data);
        $plante->save();
        $plante->categories()->attach($data['categories']);

        return $plante;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plante  $plante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plante $plante)
    {
        $plante->delete();
        return response()->json(true);
    }
}
