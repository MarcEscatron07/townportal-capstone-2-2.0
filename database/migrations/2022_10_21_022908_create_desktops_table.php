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
        Schema::create('desktops', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('computer_id')->unsigned();
            $table->string('name');
            $table->string('brand');
            $table->string('serial_number')->unique()->default('None');
            $table->decimal('cost', 18, 2);
            $table->date('purchase_date');
            $table->bigInteger('status_id')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('computer_id')->references('id')->on('computers')->onDelete('cascade');
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
        Schema::table('desktops', function (Blueprint $table) {
            $table->dropForeign(['computer_id']);
            $table->dropForeign(['status_id']);

            $table->dropColumn(['computer_id','status_id']);
        });
        
        Schema::dropIfExists('desktops');
    }
};
