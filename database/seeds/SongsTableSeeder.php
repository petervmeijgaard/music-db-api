<?php

use App\Models\Album;
use App\Models\Song;
use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Song::class, 100)
            ->make()
            ->each(function ($song) {
                $album = Album::inRandomOrder()->first();

                $song->album()->associate($album);
                $song->save();
            });
    }
}
