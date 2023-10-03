<?php

use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $dataCount=10;

        $this->command->info("Creating {$dataCount} Staffs.");
        
        $datas = factory(App\Models\Staff::class, $dataCount)->create();

        $this->command->info("{$dataCount} Staffs Created.");
    }

     // Return random value in given range
    function count($range)
    {
        return rand(...explode('-', $range));
    }
}
