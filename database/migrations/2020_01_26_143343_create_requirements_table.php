<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('clearance_stage_id')->unsigned();
            $table->string('title');
            $table->mediumText('instructions');
            $table->bigInteger('form_id')->nullable();
            $table->boolean('file_upload')->default(false);
            $table->timestamps();
            
            $table->foreign('clearance_stage_id')->references('id')->on('clearance_stages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requirements');
    }
}
