<?php

namespace App\Http\Controllers;

use App\Models\Starship;
use Illuminate\Http\Request;

class StarshipController extends Controller
{

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $starships = Starship::with('pilots')->get();

        return $starships;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function addPilot(Request $request)
    {

        $response = [];
        $request = $request->all();
        $starship_id = $request['starship_id'];
        $pilot_id = $request['pilot_id'];

        $starship = Starship::findOrFail($starship_id);

        if (empty($starship->pilots()->find($pilot_id))) {
            $starship->pilots()->attach($pilot_id);
            $response = Starship::with('pilots')->get();
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function removePilot(Request $request)
    {
        $request = $request->all();
        $starship_id = $request['starship_id'];
        $pilot_id = $request['pilot_id'];

        $starship = Starship::findOrFail($starship_id);
        $starship->pilots()->detach($pilot_id);

        return Starship::with('pilots')->get();
    }
}
