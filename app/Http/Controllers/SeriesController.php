<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        //retonar toda a coleção
        $series = Series::all();
        //ordenação sem o queryBuilder
        //$series = Series::query()->orderBy('nome')->get();
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
        $serie = Series::create($request->all());
        $seasons = [];
        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i,
            ];
        }
        Season::insert($seasons);

            $episodes = [];
            foreach ($serie->seasons as $season) {
                for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episodes);


    //  acessando diretamente a propriedade do request
    //  $nomeSerie = $request->nome;
    //  $serie = new Series();
    //  $serie->nome = $nomeSerie;
    //  $serie->save();
    //  DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]);
        return to_route('series.index')
            ->with('message.success', "Série '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy(Series $series)
    {
        $series->delete();

        return to_route('series.index')
            ->with('message.success', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('message.success', "Série '{$series->nome}' atualizada com sucesso");
    }
}
