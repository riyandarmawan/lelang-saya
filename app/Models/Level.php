<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    /** @use HasFactory<\Database\Factories\LevelFactory> */
    use HasFactory;

    protected $guarded = [];

    public function petugases() {
        return $this->hasMany(Petugas::class, 'id_level', 'id');
    }
}
