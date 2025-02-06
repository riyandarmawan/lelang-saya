<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Lelang;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\PetugasFactory> */
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function level() {
        return $this->belongsTo(Level::class, 'id_level', 'id');
    }

    public function lelangs() {
        return $this->hasMany(Lelang::class, 'id', 'id_petugas');
    }
}
