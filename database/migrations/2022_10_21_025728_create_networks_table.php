<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('networks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('location_id')->unsigned();
            $table->string('name');
            $table->string('service_provider');    
            $table->text('remarks');
            $table->bigInteger('status_id')->unsigned()->default(5);
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('networks', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropForeign(['status_id']);
            
            $table->dropColumn(['location_id','status_id']);
        });
        
        Schema::dropIfExists('networks');
    }
};
