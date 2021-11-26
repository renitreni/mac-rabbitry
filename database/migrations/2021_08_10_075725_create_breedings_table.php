<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breedings', function (Blueprint $table) {
            $table->id();
            $table->string('org_id');
            $table->string('litter_no')->nullable();
            $table->string('cage_no')->nullable();
            $table->string('parent_doe')->nullable();
            $table->string('parent_buck')->nullable();
            $table->date('date_bred')->nullable();
            $table->date('expected_kindle_date')->nullable();
            $table->date('kindle_date')->nullable();
            $table->date('weaning_date')->nullable();
            $table->date('planned_rebreed_date')->nullable();
            $table->integer('isRebreed')->nullable();
            $table->integer('born_alive')->nullable();
            $table->integer('born_dead')->nullable();
            $table->integer('total_kits')->nullable();
            $table->integer('born_doe')->nullable();
            $table->integer('born_buck')->nullable();
            $table->text('notes')->nullable();
            $table->string('inserted_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('breedings');
    }
}
