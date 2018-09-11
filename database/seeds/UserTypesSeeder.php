<?php

use Illuminate\Database\Seeder;
use App\UserType;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserType::create(array(
            'id' => '1',
            'user_type' =>'admin',
        ));
    }
}
