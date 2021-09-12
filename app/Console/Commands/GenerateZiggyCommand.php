<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateZiggyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ziggy:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish ziggy js to public folder';

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
        Artisan::call("ziggy:generate 'public/js/ziggy.js'");
        return $this->info("Ziggy.js is generated in public/js folder");
    }
}
