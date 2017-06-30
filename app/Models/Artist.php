<?php

namespace App\Models;

use App\Events\Artist\Created;
use App\Events\Artist\Deleted;
use App\Events\Artist\Updated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Artist extends Model
{
    use Searchable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'biography',
        'birthday',
        'gender',
    ];

    protected $dates = [
        'birthday',
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
     * An artist has many albums.
     *
     * @return HasMany The relationship.
     */
    public function albums() : HasMany
    {
        return $this->hasMany(Album::class);
    }
}
