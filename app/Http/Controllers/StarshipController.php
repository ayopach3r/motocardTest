<?php

namespace App\Http\Controllers;

use App\Models\Starship;
use Illuminate\Http\Request;

class StarshipController extends Controller
{
    public function index()
    {
        return Starship::with('pilots')->get();
    }
}
