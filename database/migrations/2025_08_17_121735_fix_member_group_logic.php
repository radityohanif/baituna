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
        Schema::table('member_activities', function (Blueprint $table) {
            $table->foreignId('member_group_id')->constrained()->cascadeOnDelete();
        });

        Schema::table('members', function (Blueprint $table) {
            $table->dropForeign(['member_group_id']); // drop foreign key
            $table->dropColumn('member_group_id');    // drop column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
