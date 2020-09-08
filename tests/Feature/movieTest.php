<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class movieTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
        $response->assertSee('Fake Movie');
        $response->assertSee('Action');
        $response->assertSee('Now Playing');
        $response->assertSee('Now Playing Fake Movie');
    }


    private function fakePopularMovies()
    {
        return Http::response([
                'results' => [
                    [
                        "popularity" => 1456.937,
                        "vote_count" => 159,
                        "video" => false,
                        "poster_path" => "/zVncJzXzwIO15YM1WilqYn30r54.jpg",
                        "id" => 718444,
                        "adult" => false,
                        "backdrop_path" => "/x4UkhIQuHIJyeeOTdcbZ3t3gBSa.jpg",
                        "original_language" => "en",
                        "original_title" => "Fake Movie",
                        "genre_ids" => [
                                28
                        ],
                        "title" => "Fake Movie",
                        "vote_average" => 6,
                        "overview" => "Battle-hardened O’Hara leads a lively mercenary team of soldiers on a daring mission: rescue hostages from their captors in remote Africa. But as the mission goes awry and the team is stranded, O’Hara’s squad must face a bloody, brutal encounter with a gang of rebels.",
                        "release_date" => "2020-08-20",
                    ]
                ]
            ],200);
    }

    private function fakeNowPlayingMovies()
    {
        return Http::response([
                'results' => [
                    [
                        "popularity" => 1456.937,
                        "vote_count" => 159,
                        "video" => false,
                        "poster_path" => "/zVncJzXzwIO15YM1WilqYn30r54.jpg",
                        "id" => 718444,
                        "adult" => false,
                        "backdrop_path" => "/x4UkhIQuHIJyeeOTdcbZ3t3gBSa.jpg",
                        "original_language" => "en",
                        "original_title" => "Now Playing Fake Movie",
                        "genre_ids" => [
                                28
                        ],
                        "title" => "Now Playing Fake Movie",
                        "vote_average" => 6,
                        "overview" => "Battle-hardened O’Hara leads a lively mercenary team of soldiers on a daring mission: rescue hostages from their captors in remote Africa. But as the mission goes awry and the team is stranded, O’Hara’s squad must face a bloody, brutal encounter with a gang of rebels.",
                        "release_date" => "2020-08-20",
                    ]
                ]
            ],200);
    }

    private function fakeGenres()
    {
        return null;
    }
}
