<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Starship extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'cost_in_credits'
    ];

    public function pilots()
    {
        return $this->belongsToMany(Pilot::class);
    }
}
