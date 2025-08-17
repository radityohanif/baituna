<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Academic Years
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "2025/2026"
            $table->date('start_date');
            $table->timestamps();
        });

        // Member Groups (like class or group)
        Schema::create('member_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name'); // e.g. "Grade 1", "Bimbel A"
            $table->timestamps();
        });

        // Members (students)
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_group_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });

        // Activities (like school, bimbel, etc.)
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "School", "Bimbel", "English Class"
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Fee Types (registration, monthly, etc.)
        Schema::create('fee_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Registration", "Monthly Tuition"
            $table->boolean('is_recurring')->default(false); // true = rutin bulanan
            $table->timestamps();
        });

        // Activity Fees (map activity to its fees)
        Schema::create('activity_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->cascadeOnDelete();
            $table->foreignId('fee_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_year_id')->nullable()->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->timestamps();
        });

        // Bills
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('activity_fee_id')->constrained()->cascadeOnDelete();
            $table->string('billing_month')->nullable(); // YYYY-MM (for monthly bills)
            $table->decimal('amount', 12, 2);
            $table->string('status'); // paid partial
            $table->timestamps();
        });

        // Payments
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bill_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('amount', 12, 2);
            $table->date('payment_date');
            $table->string('method')->nullable(); // cash, transfer, etc.
            $table->string('notes')->nullable();
            $table->timestamps();
        });

        // Categories (income/expense type)
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "SPP", "Gaji Guru", "ATK"
            $table->enum('type', ['income', 'expense']);
            $table->timestamps();
        });

        // Transactions (cash flow)
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->date('transaction_date');
            $table->decimal('amount', 12, 2);
            $table->string('description')->nullable();
            $table->timestamps();
            $table->nullableMorphs('reference');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('bills');
        Schema::dropIfExists('activity_fees');
        Schema::dropIfExists('fee_types');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('members');
        Schema::dropIfExists('member_groups');
        Schema::dropIfExists('academic_years');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('transactions');
    }
};
