<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Starship;

class StarshipController extends Controller
{
    function getData()
    {
        return Starship::with('pilots')->get();
    }
}
