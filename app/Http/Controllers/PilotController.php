<?php

namespace App\Http\Controllers;

use App\Models\Pilot;
use Illuminate\Http\Request;

class PilotController extends Controller
{
    /**
     * @return Pilot[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $pilots = Pilot::all();

        return $pilots;
    }
}
