<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index()
    {
        //retonar toda a coleção
        //$series = Serie::all();

        $series = Serie::query()->orderBy('nome')->get();
        return view('series.index')->with('series', $series);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {

    //  mass assignement
        Serie::create($request->all());

    //  acessando diretamente a propriedade do request
    //  $nomeSerie = $request->nome;
    //  $serie = new Serie();
    //  $serie->nome = $nomeSerie;
    //  $serie->save();
    //  DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]);
        return redirect('/series');


    }
}
