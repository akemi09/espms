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
        Schema::table('opcrs', function (Blueprint $table) {
            $table->text('comments')->after('status')->nullable();
            $table->integer('parent_id')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('opcrs', function (Blueprint $table) {
            $table->dropColumn('comments');
            $table->dropColumn('parent_id');
        });
    }
};
