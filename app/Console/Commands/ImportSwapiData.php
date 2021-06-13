<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Repositories\Swapi;

class ImportSwapiData extends Command
{
    const STARSHIPS_TABLE_NAME = 'starships';
    const PILOTS_TABLE_NAME = 'pilots';
    const PILOT_STARSHIP_TABLE_NAME = 'pilot_starship';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:importSwapiData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import SWAPI data into our database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $swapi = new Swapi();
        $starships = $swapi->getAllStarships();
        $pilots = $swapi->getAllPilots();

        $this->refreshTable(
            $starships[ImportSwapiData::STARSHIPS_TABLE_NAME],
            ImportSwapiData::STARSHIPS_TABLE_NAME
        );

        $this->refreshTable(
            $pilots[ImportSwapiData::PILOTS_TABLE_NAME],
            ImportSwapiData::PILOTS_TABLE_NAME
        );

        $this->refreshTable(
            $starships[ImportSwapiData::PILOT_STARSHIP_TABLE_NAME],
            ImportSwapiData::PILOT_STARSHIP_TABLE_NAME
        );

        return 0;
    }

    /**
     * @param $data
     * @param $table_name
     * @return bool
     */
    private function refreshTable($data, $table_name)
    {
        $result = false;

        if (!empty($data)) {
            $this->info('Refreshing table ' . $table_name . '...');
            $query = DB::table($table_name)->delete();
            DB::statement("ALTER TABLE $table_name AUTO_INCREMENT = 1");

            $this->info('Importing data to ' . $table_name . '...');
            $query = DB::table($table_name)->insert($data);

            if ($query) {
                $this->info('Imported data');
                $result = true;
            }
        } else {
            $this->error('No data to import');
        }

        return $result;
    }

}
