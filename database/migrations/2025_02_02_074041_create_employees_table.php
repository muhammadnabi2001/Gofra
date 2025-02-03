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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('img')->nullable();
        
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->float('daily_hours')->default(0);
            $table->float('monthly_hours')->default(0);
        
            $table->enum('work_schedule', ['full_time', 'part_time', 'shift']);
            $table->enum('salary_type', ['fixed', 'hourly', 'per_task']);
        
            $table->double('salary')->nullable();
            $table->double('rate')->nullable();
            $table->double('task_rate')->nullable();
        
            $table->decimal('advance', 10, 2)->default(0);
            $table->decimal('fine', 10, 2)->default(0);
            $table->decimal('bonus', 10, 2)->default(0);
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
