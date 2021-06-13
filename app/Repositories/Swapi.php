<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class Swapi
{
    const PAGE_ONE = 1;
    const PILOT_ID_POSITION_URL = 5;
    const STARSHIP_ID_POSITION_URL = 5;

    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllStarships()
    {
        $page = Swapi::PAGE_ONE;
        $result = [];

        $headers = [
            'Content-Type' => 'application/json'
        ];

        do {
            $response = $this->client->get(
                env('SWAPI_BASE_URL') . '/starships/?page=' . $page,
                ['headers' => $headers]
            );

            if (!empty($response)) {
                $data = json_decode($response->getBody()->getContents());
                $data_results = $data->results;

                if (!empty($data_results)) {
                    foreach ($data_results as $data_result) {
                        $starships_id = explode('/', $data_result->url)[Swapi::STARSHIP_ID_POSITION_URL];

                        $result['starships'][] = [
                            'id' => (int) $starships_id,
                            'name' => $data_result->name,
                            'model' => $data_result->model,
                            'manufacturer' => $data_result->manufacturer,
                            'cost_in_credits' => (int) $data_result->cost_in_credits,
                            'length' => (int) $data_result->length,
                            'max_atmosphering_speed' => (double) $data_result->max_atmosphering_speed,
                            'crew' => $data_result->crew,
                            'passengers' => (int) $data_result->passengers,
                            'cargo_capacity' => (int) $data_result->cargo_capacity,
                            'consumables' => $data_result->consumables,
                            'hyperdrive_rating' => (double) $data_result->hyperdrive_rating,
                            'mglt' => (int) $data_result->MGLT,
                            'starship_class' => $data_result->starship_class,
                            'created' => new \DateTime($data_result->created),
                            'edited' => new \DateTime($data_result->edited)
                        ];

                        $pilots = $data_result->pilots;

                        if (!empty($pilots)) {
                            foreach ($pilots as $pilot) {
                                $pilot_id = explode('/', $pilot)[Swapi::PILOT_ID_POSITION_URL];
                                $result['pilot_starship'][] = [
                                    'pilot_id' => (int) $pilot_id,
                                    'starship_id' => (int) $starships_id
                                ];
                            }
                        }
                    }
                }

                $page += 1;
            }
        } while (!empty($data->next) || empty($response));

        return $result;
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllPilots()
    {
        $page = Swapi::PAGE_ONE;
        $result = [];

        $headers = [
            'Content-Type' => 'application/json'
        ];

        do {
            $response = $this->client->get(
                env('SWAPI_BASE_URL') . '/people/?page=' . $page,
                ['headers' => $headers]
            );

            if (!empty($response)) {
                $data = json_decode($response->getBody()->getContents());
                $data_results = $data->results;

                if (!empty($data_results)) {
                    foreach ($data_results as $data_result) {
                        $pilot_id = explode('/', $data_result->url)[Swapi::PILOT_ID_POSITION_URL];

                        $result['pilots'][] = [
                            'id' => (int) $pilot_id,
                            'name' => $data_result->name,
                            'height' => (int) $data_result->height,
                            'mass' => (int) $data_result->mass,
                            'hair_color' => $data_result->hair_color,
                            'skin_color' => $data_result->skin_color,
                            'eye_color' => $data_result->eye_color,
                            'birth_year' => $data_result->birth_year,
                            'gender' => $data_result->gender,
                            'created' => new \DateTime($data_result->created),
                            'edited' => new \DateTime($data_result->edited)
                        ];
                    }
                }

                $page += 1;
            }
        } while (!empty($data->next) || empty($response));

        return $result;
    }

}
