<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $popularTv = Http::withToken(config('services.tmbd.token'))
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];
        $topRatedTv = Http::withToken(config('services.tmbd.token'))
            ->get('https://api.themoviedb.org/3/tv/top_rated')
            ->json()['results'];
        $genres = Http::withToken(config('services.tmbd.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];
//        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
//            return [$genre['id'] => $genre['name']];
//        });
//        return view('movie.index', [
//            'popularMovies' => $popularMovies,
//            'nowPlayingMovies' => $nowPlayingMovies,
//            'genres' => $genres,
//        ]);

        $viewModel = new TvViewModel(
            $popularTv,
            $topRatedTv,
            $genres
        );
        return view('tv.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $tvshow = Http::withToken(config('services.tmbd.token'))
            ->get('https://api.themoviedb.org/3/tv/'. $id.'?append_to_response=credits,videos,images')
            ->json();

        $viewModel = new TvShowViewModel($tvshow);
        return view('tv.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
