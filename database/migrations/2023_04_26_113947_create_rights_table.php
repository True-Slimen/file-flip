<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rights', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')
            ->references('id')
            ->on('groups')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->unsignedBigInteger('file_id')->nullable();
            $table->foreign('file_id')
            ->references('id')
            ->on('files')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->unsignedBigInteger('folder_id')->nullable();
            $table->foreign('folder_id')
            ->references('id')
            ->on('folders')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rights');
    }
}