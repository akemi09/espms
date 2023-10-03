<?php

use App\Models\MfoPap;
use App\Models\TargetType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mfo_pap_target_types', function (Blueprint $table) {
            $table->foreignIdFor(MfoPap::class);
            $table->foreignIdFor(TargetType::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mfo_pap_target_types');
    }
};
