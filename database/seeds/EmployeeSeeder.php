<?php

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'name' => 'Gerardo Aquino',
            'email' => 'mogurbon@gmail.com',
            'position' => 'developer',
            'birthday'=> '1976-10-31',
            'address' =>'Wisconsin 64, Nápoles, Ciudad de México, CDMX'
        ]);
    }
}
