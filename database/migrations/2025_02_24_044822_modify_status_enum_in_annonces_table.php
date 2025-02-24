<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('annonces', function (Blueprint $table) {
            $table->enum('status', ['pending', 'accepted', 'archive'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('annonces', function (Blueprint $table) {
            $table->enum('status', ['actif', 'brouillon', 'archive'])->default('actif')->change();
        });
    }
};
