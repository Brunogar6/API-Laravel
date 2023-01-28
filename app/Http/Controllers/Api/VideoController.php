<?php

namespace App\Http\Controllers\Api;

use App\Models\Video;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoPostRequest;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->has('search')) {
            return Video::query()->paginate(5);
        }

        return Video::whereTitulo($request->search)->get();
    }

    public function store(VideoPostRequest $request)
    {
        $categoria_id = $request->categoria_id;

        if (!Categoria::exists())
        {Categoria::create([
            'titulo' => 'Livre',
            'descricao' => 'Categoria Livre'
        ]);
        }

        if ($request->categoria_id === null){
            $categoria_id = 1;
        }
        $video = Video::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'url' => $request->url,
            'categoria_id' => $categoria_id,
        ]);

        return response()->json($video, 201);
    }

    public function show(int $video)
    {
        $videoModel = Video::find($video);

        if ($videoModel === null){
            return response()->json(['menssage' => 'Não Encontrado'], 404);
        }

        return $videoModel;
    }

    public function update(Video $video, Request $request)
    {
        $video->fill($request->all());
        $video->save();

        return $video;
    }

    public function destroy(int $video)
    {
        Video::destroy($video);

        return response()->noContent();
    }

    public function free()
    {
        return Video::all()->take(3);
    }
}
