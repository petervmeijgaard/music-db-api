<?php

namespace App\Models;

use App\Events\Album\Created;
use App\Events\Album\Deleted;
use App\Events\Album\Updated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Album extends Model
{
    use Searchable, SoftDeletes;

    protected $fillable = [
        'title',
        'release_date',
    ];

    protected $dates = [
        'release_date',
    ];

    /**
     * The event map for the model.
     *
     * Allows for object-based events for native Eloquent events.
     *
     * @var array The event mapping.
     */
    protected $events = [
        'created' => Created::class,
        'updated' => Updated::class,
        'deleted' => Deleted::class,
    ];

    /**
     * An album belongs to an artist.
     *
     * @return BelongsTo The relationship.
     */
    public function artist() : BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * An album has many songs.
     *
     * @return HasMany The relationship.
     */
    public function songs() : HasMany
    {
        return $this->hasMany(Song::class);
    }
}
