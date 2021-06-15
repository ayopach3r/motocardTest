<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function starships() {
        return $this->belongsToMany(Starship::class);
    }
}
