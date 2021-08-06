<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;


class SearchDrowpdown extends Component
{
    public $search = '';
    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) >= 2) {
            $searchResults = Http::withToken(config('services.tmbd.token'))
            ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
            ->json()['results'];
        }

//            dump($searchResults);

        return view('livewire.search-drowpdown', [
            'searchResults' => collect( $searchResults )->take(7),
        ]);
    }
}
