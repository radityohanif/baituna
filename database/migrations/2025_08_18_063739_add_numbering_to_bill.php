<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->string('number')->nullable()->after('id');
        });

        $bills = DB::table('bills')->orderBy('id')->get();
        $counter = 1;
        foreach ($bills as $bill) {
            $no = 'BILL' . now()->format('ymd') . str_pad($counter, 3, '0', STR_PAD_LEFT);
            DB::table('bills')->where('id', $bill->id)->update(['number' => $no]);
            $counter++;
        }

        Schema::table('bills', function (Blueprint $table) {
            $table->string('number')->unique()->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn('number');
        });
    }
};
