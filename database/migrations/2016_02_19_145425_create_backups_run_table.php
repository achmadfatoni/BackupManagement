<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackupsRunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backups_run', function (Blueprint $table) {
            $table->increments('id');
            $table->text('path_to_backup');
            $table->text('file_size');
            $table->text('output_text');
            $table->text('error_text');
            $table->boolean('is_deleted');
            $table->boolean('is_synced')->default(0);
            $table->boolean('is_on_demand')->default(0);
            $table->boolean('is_completed');
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
        Schema::drop('backups_run');
    }
}
