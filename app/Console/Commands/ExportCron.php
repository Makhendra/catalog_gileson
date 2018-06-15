<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\MyLibrary\Export;

class ExportCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Экспорт данных с сайта https://markethot.ru/';

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
        Export::run();
    }
}
