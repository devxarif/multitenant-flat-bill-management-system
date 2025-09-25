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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('building_id')->constrained()->cascadeOnDelete();
            $table->foreignId('flat_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bill_category_id')->constrained('bill_categories')->cascadeOnDelete();
            $table->date('month');
            $table->decimal('amount', 10, 2);
            $table->decimal('carried_due', 10, 2)->default(0);
            $table->decimal('total_due', 10, 2);
            $table->enum('status', ['unpaid','paid','partial'])->default('unpaid')->index();
            $table->text('notes')->nullable();
            $table->index(['owner_id','flat_id','status','month']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
