<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mfo_pap_offices', function (Blueprint $table) {
            $table->unsignedBigInteger('mfo_pap_id');
            $table->integer('office_id');
            $table->foreign('mfo_pap_id')->references('id')->on('mfo_paps');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mfo_pap_offices');
    }
};
