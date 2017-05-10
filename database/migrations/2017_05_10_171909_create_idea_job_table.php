<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeaJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idea_job', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();

            # `idea_id` will reference the `ideas table` and `job_id` will reference the `jobs` table.
            $table->integer('idea_id')->unsigned();
            $table->integer('job_id')->unsigned();

            # Make foreign keys
            $table->foreign('idea_id')->references('id')->on('ideas');
            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('idea_job');
    }
}
