<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeasTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
      Schema::create('ideas', function (Blueprint $table) {

          # Make a Primary, Auto-Incrementing field
          $table->increments('id');

          # This generates two columns: `created_at` and `updated_at` to
          # keep track of changes to a row
          $table->timestamps();

          # Other fields
          $table->string('idea_name');
          $table->string('description');
          $table->string('stage')->nullable();

    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
      Schema::drop('ideas');
  }
}
