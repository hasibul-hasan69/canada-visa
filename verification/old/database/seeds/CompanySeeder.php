<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $dataCount=100;

        $this->command->info("Creating {$dataCount} Company.");
        
        $datas = factory(App\Models\Company::class, $dataCount)->create();

        $this->command->info("{$dataCount} Company Created.");
    }

     // Return random value in given range
    function count($range)
    {
        return rand(...explode('-', $range));
    }
}
