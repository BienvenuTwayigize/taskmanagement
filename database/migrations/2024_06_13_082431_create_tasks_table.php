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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('assigned_by')->constrained('users');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('assigned_to')->nullable()->constrained('users');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('reminder_start_date')->nullable();
            $table->date('reminder_end_date')->nullable();
            $table->enum('status', ['pending', 'inprogress', 'overdue', 'completed'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->string('category')->nullable();
            $table->json('tags')->nullable();
            $table->json('attachments')->nullable();
            $table->text('comments')->nullable();
            $table->boolean('is_recurring')->default(false);
            $table->enum('recurrence_interval', ['daily', 'weekly', 'monthly'])->nullable();
            $table->foreignId('parent_task_id')->nullable()->constrained('tasks');
            $table->integer('progress')->default(0); // 0 to 100 percentage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
