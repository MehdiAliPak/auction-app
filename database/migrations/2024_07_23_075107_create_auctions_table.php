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
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->json('images')->nullable();
            $table->string('file')->nullable();
            $table->text('description');
            $table->unsignedInteger('base_price');
            $table->unsignedInteger('final_price')->nullable();
            $table->dateTime('start_date'); // date that auction starts
            $table->dateTime('end_date');
            $table->dateTime('register_start_date'); // date that auction register starts
            $table->dateTime('register_end_date');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'ongoing', 'finished', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};