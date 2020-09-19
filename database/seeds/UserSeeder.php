<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::forceCreate([
            'name' => 'Administrador',
            'email' => 'test@gmail.com',
            'password' => bcrypt('freelance'),
            'api_token' => Str::random(80),

            
            'lastname' => 'Usuario',
            'identification' => '0000000000',
            'documentType' => 'nn',
        ]);
    }
}
