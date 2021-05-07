<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [            
                [
                    'email' => 'admin@mail.com',
                
                
                    'firstname' => 'admin',
                    
                    
                    'lastname' => 'admin',
                    
                
                    'password' => '$2y$10$dBOJbM3571pxPrPYDuteDOpw0Ux7w0ideLaD/OwoU/AvWJjPSTcHi'
                ],
                [
                    'email' => 'pineau@mail.com',
                
                
                    'firstname' => 'Lulu',
                    
                    
                    'lastname' => 'Pineau',
                    
                
                    'password' => '$2y$10$dBOJbM3571pxPrPYDuteDOpw0Ux7w0ideLaD/OwoU/AvWJjPSTcHi'
                ],
                [
                    'email' => 'patral@mail.com',
                
                
                    'firstname' => 'Bob',
                    
                    
                    'lastname' => 'Patral',
                    
                
                    'password' => '$2y$10$dBOJbM3571pxPrPYDuteDOpw0Ux7w0ideLaD/OwoU/AvWJjPSTcHi'
                ],
                [
                    'email' => 'mishkanov@mail.com',
                
                
                    'firstname' => 'Igor',
                    
                    
                    'lastname' => 'Mishkanov',
                    
                
                    'password' => '$2y$10$dBOJbM3571pxPrPYDuteDOpw0Ux7w0ideLaD/OwoU/AvWJjPSTcHi'
                ],
                [
                    'email' => 'adelaïde@mail.com',
                
                
                    'firstname' => 'Adelaïde',
                    
                    
                    'lastname' => 'Menya',
                    
                
                    'password' => '$2y$10$dBOJbM3571pxPrPYDuteDOpw0Ux7w0ideLaD/OwoU/AvWJjPSTcHi'
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
