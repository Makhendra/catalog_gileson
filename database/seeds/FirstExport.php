<?php

use Illuminate\Database\Seeder;
use \App\MyLibrary\Export;

class FirstExport extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        Export::run();
    }
}
