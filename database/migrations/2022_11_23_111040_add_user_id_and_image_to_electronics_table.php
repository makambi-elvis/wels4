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
        Schema::table('electronics', function (Blueprint $table) {
            $table -> foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('electronics', function (Blueprint $table) {
            $table ->dropConstrainedForeignId('owner_id');
            $table->dropColumn('image');
        });
    }
};
