<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platform extends Model
{
    protected $fillable = ['name'];

    public function streamer():HasMany{
        return $this->hasMany(Streamer::class);
    }
}
