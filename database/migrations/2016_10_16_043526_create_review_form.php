<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('medical_reviews', function($table)
      {
        $table->increments('id');
        $table->integer('medical_record_id');
        $table->text('summary')->nullable();
        $table->text('investigation')->nullable();
        $table->text('outcomes')->nullable();
        $table->text('differential_diagnosis')->nullable();
        $table->text('treatment')->nullable();
        $table->text('discussion')->nullable();        
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
