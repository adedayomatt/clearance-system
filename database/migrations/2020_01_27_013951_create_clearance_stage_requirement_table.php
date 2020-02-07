<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClearanceStageRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearance_stage_requirement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('primary_stage_id')->unsigned();
            $table->bigInteger('secondary_stage_id')->unsigned();
            $table->timestamps();

            $table->foreign('primary_stage_id')->references('id')->on('clearance_stages')->onDelete('cascade');
            $table->foreign('secondary_stage_id')->references('id')->on('clearance_stages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clearance_stage_requirement');
    }
}
