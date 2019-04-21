<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'remove all automatically generated models';

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
        $path="/var/www/html/SISReDesign/app/";
        exec("rm ".$path."*Model.php");//
    }
}
