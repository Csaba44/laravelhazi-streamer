<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Streamer extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','platform_id','followers'];

    public function platforms():BelongsTo{
        return $this->belongsTo(Platform::class);
    }

    public function games():BelongsToMany{
        return $this->belongsToMany(Game::class,'streams')->withPivot('title','duration_seconds','is_live','views');
    }
}
