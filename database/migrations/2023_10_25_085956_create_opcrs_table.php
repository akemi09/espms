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
        Schema::create('opcrs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('mfo_pap_id')->constrained()->onDelete('cascade');
            $table->text('targets');
            $table->string('alloted_budget')->nullable();
            $table->string('accoutable')->nullable();
            $table->text('actual_accomplishments')->nullable();
            $table->string('q1')->default(0)->nullable();
            $table->string('e2')->default(0)->nullable();
            $table->string('t3')->default(0)->nullable();
            $table->string('a4')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opcrs');
    }
};
