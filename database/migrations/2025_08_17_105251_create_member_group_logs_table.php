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
        Schema::create('member_group_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('member_group_id')->constrained()->cascadeOnDelete();
        });

        Schema::table('member_groups', function (Blueprint $table) {
            $table->foreignId('activity_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_group_logs');
    }
};
