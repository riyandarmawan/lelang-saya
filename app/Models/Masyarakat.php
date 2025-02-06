<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Masyarakat extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\MasyarakatFactory> */
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function lelangs() {
        return $this->hasMany(Lelang::class, 'id', 'id_user');
    }
}
