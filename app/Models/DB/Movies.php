<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Movies extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'IMDb',
        'title_original',
        'trailer_url',
        'type',
        'time',
        'esp_total',
        'esp_current',
        'slug',
        'description',
        'produce_by',
        'release_year',
        'thumbnail',
    ];

    public function episodes(): HasMany
    {
        return $this->hasMany(Episodes::class, 'movie_id');
    }

    
    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actors::class, 'movie_actor', 'movie_id', 'actor_id');
    }
    
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genres::class, 'movie_genre', 'movie_id', 'genre_id');
    }
    
    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Genres::class, 'movie_language', 'movie_id', 'language_id');
    }
    
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Images::class, 'movie_image', 'movie_id', 'image_id');
    }

    public function history(): HasOne
    {
        return $this->hasOne(History::class, 'movie_id');
    }

    public function favourite(): HasOne
    {
        return $this->hasOne(Favourite::class, 'movie_id');
    }
}
