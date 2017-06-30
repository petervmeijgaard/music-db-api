<?php

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Album::class, 20)
            ->make()
            ->each(function ($album) {
                $artist = Artist::inRandomOrder()->first();

                $album->artist()->associate($artist);
                $album->save();
            });
    }
}
