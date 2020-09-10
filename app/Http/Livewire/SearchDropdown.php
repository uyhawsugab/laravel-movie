<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;



class SearchDropdown extends Component
{
    public $search = "hello there";
    
    public function render()
    {

        $searchResults = [];

        $searchResults = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
            ->json()['results'];
        
        return view('livewire.search-dropdown', [
            'searchResults' => $searchResults,
        ]);
    }
}
