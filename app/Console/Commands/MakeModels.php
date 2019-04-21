<?php

namespace App\Console\Commands;
use App\ModelMaker;

use Illuminate\Console\Command;

class MakeModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'uses the ModelMaker class to create models for each table in the sis database';

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
     * @return mixed
     */
    public function handle()
    {
        new ModelMaker;
        //
    }
}
