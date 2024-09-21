<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debt_id')->constrained()->onDelete('cascade'); // Reference to debt
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference to user
            $table->decimal('amount', 15, 2); // Payment amount
            $table->date('payment_date'); // Date when the payment was made
            $table->string('payment_method')->nullable(); // Payment method (e.g., cash, bank transfer)
            $table->enum('status', ['pending', 'completed'])->default('completed'); // Status of the payment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
