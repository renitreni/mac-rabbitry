<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRabbitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rabbits', function (Blueprint $table) {
            $table->id();
            $table->string('org_id');
            $table->string('tag_id')->nullable();
            $table->integer('breeding_id')->nullable();
            $table->string('cage_no')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('breed_id')->nullable();
            $table->string('type')->nullable();
            $table->string('color')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('origin')->nullable();
            $table->string('home_breed')->nullable();
            $table->string('notes')->nullable();
            $table->string('avatar')->nullable();
            $table->string('inserted_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('is_draft')->nullable();
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
        Schema::dropIfExists('rabbits');
    }
}
