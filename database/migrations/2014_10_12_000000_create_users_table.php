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
                    
                
                    'password' => '$10$D2MpzPMHuVJzUQD0TBNU4.iapQgYwHWPvWOqGI..brafFOtO1iQ7a'
                ],
                [
                    'email' => 'pineau@mail.com',
                
                
                    'firstname' => 'Lulu',
                    
                    
                    'lastname' => 'Pineau',
                    
                
                    'password' => '$10$D2MpzPMHuVJzUQD0TBNU4.iapQgYwHWPvWOqGI..brafFOtO1iQ7a'
                ],
                [
                    'email' => 'patral@mail.com',
                
                
                    'firstname' => 'Bob',
                    
                    
                    'lastname' => 'Patral',
                    
                
                    'password' => '$10$D2MpzPMHuVJzUQD0TBNU4.iapQgYwHWPvWOqGI..brafFOtO1iQ7a'
                ],
                [
                    'email' => 'mishkanov@mail.com',
                
                
                    'firstname' => 'Igor',
                    
                    
                    'lastname' => 'Mishkanov',
                    
                
                    'password' => '$10$D2MpzPMHuVJzUQD0TBNU4.iapQgYwHWPvWOqGI..brafFOtO1iQ7a'
                ],
                [
                    'email' => 'adelaïde@mail.com',
                
                
                    'firstname' => 'Adelaïde',
                    
                    
                    'lastname' => 'Menya',
                    
                
                    'password' => '$10$D2MpzPMHuVJzUQD0TBNU4.iapQgYwHWPvWOqGI..brafFOtO1iQ7a'
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
