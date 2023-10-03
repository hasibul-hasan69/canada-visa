<?php

use Illuminate\Database\Seeder;

class JobSeekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $this->command->info("Job Seeker Creating.");
       
        $datas=App\Models\Company::all();
        $datas->each(function($data){
            factory(App\Models\JobSeeker::class, $this->count("5-15"))
                    ->create(['companyId' => $data->id]);
        });
        $this->command->info("JobSeeker Created.");
    }

     // Return random value in given range
    function count($range)
    {
        return rand(...explode('-', $range));
    }
}
