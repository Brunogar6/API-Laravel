<?php

namespace App\Http\Controllers\Api;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaPostRequest;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        dd($request);

        return Categoria::all();
    }

    public function store(CategoriaPostRequest $request)
    {
        $categoria = Categoria::create([
            'titulo' => $request->titulo,
            'cor' => $request->cor,
        ]);

        return response()->json($categoria, 201);
    }

    public function show(int $categoria)
    {
        
        $categoriaModel = Categoria::find($categoria);

        if ($categoriaModel === null){
            return response()->json(['menssage' => 'Não Encontrado'], 404);
        }

        return $categoriaModel;
    }

    public function update(Categoria $categoria, Request $request)
    {
        $categoria->fill($request->all());
        $categoria->save();

        return $categoria;
    }

    public function destroy(int $categoria)
    {
        categoria::destroy($categoria);

        return response()->noContent();
    }

    public function videos(Categoria $categoria)
    {
        return $categoria->videos;
    }
}
