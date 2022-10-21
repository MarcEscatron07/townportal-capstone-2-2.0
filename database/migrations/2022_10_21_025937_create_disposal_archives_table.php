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
        Schema::create('disposal_archives', function (Blueprint $table) {
            $table->id();
            $table->string('assigned_computer');
            $table->string('name');
            $table->string('brand');
            $table->string('type');
            $table->string('serial_number')->unique();
            $table->decimal('cost', 18, 2)->unsigned();  
            $table->date('purchase_date');
            $table->date('disposal_date');
            $table->dateTime('archived_at');
            $table->tinyInteger('hasDetails')->default(0);
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
        Schema::dropIfExists('disposal_archives');
    }
};
