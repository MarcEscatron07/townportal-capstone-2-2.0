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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('username')->unique()->after('id');
            $table->string('firstname')->after('username');
            $table->string('lastname')->after('firstname');
            $table->string('image')->nullable()->after('password')->default('images/profile/default.png');
            $table->bigInteger('user_role_id')->unsigned()->after('image')->default(3);

            $table->foreign('user_role_id')->references('id')->on('user_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_role_id']);
            $table->dropColumn('user_role_id');
        });
    }
};
