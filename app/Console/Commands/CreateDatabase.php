<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates database based on .env parameters.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $connection = DB::connection('noDatabaseConnection');

        $connection->statement('CREATE DATABASE IF NOT EXISTS '. env('DB_DATABASE'));
    }
}
