<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        //retonar toda a coleção
        //$series = Serie::all();

        $series = Serie::query()->orderBy('nome')->get();
        $messageSuccess = session('message.success');
        /*com o ->flash não precisa usar o forget
         * $request->session()->forget('message.success');
        */
        return view('series.index')->with('series', $series)
            ->with('messageSuccess', $messageSuccess);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {

    //  mass assignement
        $serie = Serie::create($request->all());

    //  acessando diretamente a propriedade do request
    //  $nomeSerie = $request->nome;
    //  $serie = new Serie();
    //  $serie->nome = $nomeSerie;
    //  $serie->save();
    //  DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]);
        return to_route('series.index')
            ->with('message.success', "Série '{$serie->nome}' adicionada com sucesso");


    }

    public function destroy(Serie $series)
    {
        $series->delete();


        return to_route('series.index')
            ->with('message.success', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Serie $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Serie $series,SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('message.success', "Série '{$series->nome}' atualizada com sucesso");;
    }
}
