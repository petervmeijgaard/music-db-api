<?php

namespace App\Models;

use App\Events\Song\Created;
use App\Events\Song\Deleted;
use App\Events\Song\Updated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Song extends Model
{
    use Searchable, SoftDeletes;

    protected $fillable = [
        'title',
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
     * A song belongs to an album.
     *
     * @return BelongsTo The relationship.
     */
    public function album() : BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
