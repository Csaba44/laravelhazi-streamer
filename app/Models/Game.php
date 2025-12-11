<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    protected $fillable = ['name','genre_id','release_date'];

    public function genre():BelongsTo{
        return $this->belongsTo(Genre::class);
    }

    public function streamers():BelongsToMany{
        return $this->belongsToMany(Streamer::class,'streams')->withPivot('title', 'duration_seconds', 'is_live', 'views');
    }
}
