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
        Schema::create('disposal_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('disposal_archive_id')->unsigned();
            $table->string('name');
            $table->string('brand');
            $table->string('type');
            $table->string('serial_number')->unique();
            $table->decimal('cost', 18, 2)->unsigned();
            $table->date('purchase_date');
            $table->text('disposal_reason');
            $table->timestamps();

            $table->foreign('disposal_archive_id')->references('id')->on('disposal_archives');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('disposal_details', function (Blueprint $table) {
            $table->dropForeign(['disposal_archive_id']);

            $table->dropColumn('disposal_archive_id');
        });
        
        Schema::dropIfExists('disposal_details');
    }
};
