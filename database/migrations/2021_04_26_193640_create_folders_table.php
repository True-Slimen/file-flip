<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->unsignedBigInteger('file_id');
            $table->foreign('file_id')
            ->references('id')
            ->on('files')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->unsignedBigInteger('folder_id');
            $table->foreign('folder_id')
            ->references('id')
            ->on('folders')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->string('foldername');
            $table->string('folderpath');
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
        Schema::dropIfExists('folders');
    }
}
