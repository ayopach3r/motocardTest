<?php

namespace Tests\Feature;

use App\Models\Pilot;
use App\Models\Starship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StarshipTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * @test
     */
    public function starShipsList()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function addNewPilotToStarship()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/starships/10/addPilot', [
            'starship_id' => 10,
            //'starship_id' => 'motocard',
            'pilot_id' => 5
        ]);

        $response->assertOk();

        $this->assertCount(36, Starship::all());

        $starship = Starship::findOrFail(10);
        $pilot = Pilot::findOrFail(5);

        $this->assertEquals($starship->id, 10);
        $this->assertEquals($pilot->id, 5);

    }

    /**
     * @test
     */
    public function removeNewPilotToStarship()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/starships/10/removePilot', [
            'starship_id' => 10,
            //'starship_id' => 'motocard',
            'pilot_id' => 5
        ]);

        $response->assertOk();

        $this->assertCount(36, Starship::all());

        $starship = Starship::findOrFail(10);
        $pilot = Pilot::findOrFail(5);

        $this->assertEquals($starship->id, 10);
        $this->assertEquals($pilot->id, 5);

    }
}
