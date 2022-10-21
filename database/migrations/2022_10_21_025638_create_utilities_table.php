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
        Schema::create('utilities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('computer_id')->unsigned();
            $table->string('name');
            $table->string('brand')->default('None');            
            $table->bigInteger('type_id')->unsigned();
            $table->decimal('cost', 18, 2)->unsigned();
            $table->date('purchase_date');
            $table->bigInteger('status_id')->unsigned()->default(7);
            $table->text('remarks');
            $table->timestamps();

            $table->foreign('computer_id')->references('id')->on('computers')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types');
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
        Schema::table('utilities', function (Blueprint $table) {
            $table->dropForeign(['computer_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['status_id']);

            $table->dropColumn(['computer_id','type_id','status_id']);
        });
        
        Schema::dropIfExists('utilities');
    }
};
