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
        Schema::table('hire_requests', function (Blueprint $table) {
            $table -> boolean('accepted')->nullable();
            $table->boolean('rejected')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hire_requests', function (Blueprint $table) {
            $table ->dropColumn('accepted');
            $table->dropColumn('rejected');
        });
    }
};
