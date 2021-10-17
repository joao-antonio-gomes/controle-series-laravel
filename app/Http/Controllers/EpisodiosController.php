<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Serie;
use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Request $request, Serie $serie, Temporada $temporada)
    {
        $episodios = $temporada->episodios;
        $mensagem = $request->session()->get('mensagem');


        return view('episodios.index', compact('episodios', 'serie', 'temporada', 'mensagem'));
    }

    public function assistir(Request $request, Serie $serie, Temporada $temporada)
    {
        $episodiosAssistidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssistidos) {
           $episodio->assistido = in_array($episodio->id, $episodiosAssistidos);
        });
        $temporada->push();

        $request->session()->flash('mensagem', "Episódios marcados como assistidos");
        return redirect()->back();
    }
}
