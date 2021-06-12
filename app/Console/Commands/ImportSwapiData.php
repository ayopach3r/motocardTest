<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportSwapiData extends Command
{
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
        $confirm = $this->confirm('Do you want to import data from SWAPI?');

        if ($confirm) {
            $this->info('Importing data ...');
        }

        return 0;
    }
}
