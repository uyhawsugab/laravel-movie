<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Carbon;

class MoviesViewModel extends ViewModel
{
    public $popularMovies, $nowPlayingMovies, $genres;

    public function __construct($popularMovies, $nowPlayingMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;
    }

    private function formatMovies($movies)
    {

        


        return collect($movies)->map(function($movie){

            $genresFormat = collect($movie['genre_ids'])->mapWithKeys(function($val){
            return [$val => $this->genres()->get($val)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
                'vote_average' => $movie['vote_average'] *10 .'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormat,
            ]);
        });
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlayingMovies()
    {
       return $this->formatMovies($this->nowPlayingMovies);
    }


    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id'] => $genre['name']];
        });
    }
}
