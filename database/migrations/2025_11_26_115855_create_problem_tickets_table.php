<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('problem_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id')->unique();
            $table->string('status')->default('Pending'); // Pending, In Progress, Completed, Closed

            // Foreign keys
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedBigInteger('problem_type_id');
            $table->unsignedBigInteger('problem_area_id');
            $table->unsignedBigInteger('notification_source_id');

            // Guest details
            $table->string('guest_name')->nullable();
            $table->string('guest_contact')->nullable();
            $table->string('room_no')->nullable();
            $table->date('check_in_date')->nullable();
            $table->date('check_out_date')->nullable();

            // Problem details
            $table->longText('problem_description')->nullable();

            // Action details
            $table->longText('action_taken')->nullable();
            $table->dateTime('actioned_at')->nullable();

            // Follow-up
            $table->longText('follow_up')->nullable();
            $table->dateTime('followed_up_at')->nullable();

            // Compensation
            $table->string('compensation')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->dateTime('compensation_given_at')->nullable();

            // Track who updated
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();

            // Foreign keys constraints
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->foreign('problem_type_id')->references('id')->on('problem_types')->onDelete('cascade');
            $table->foreign('problem_area_id')->references('id')->on('problem_areas')->onDelete('cascade');
            $table->foreign('notification_source_id')->references('id')->on('notification_sources')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problem_tickets');
    }
};
