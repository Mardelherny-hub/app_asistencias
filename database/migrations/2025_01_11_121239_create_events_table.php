<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/[timestamp]_create_events_table.php
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('location')->nullable();
            $table->foreignId('user_id')->constrained(); // Organizador del evento
            $table->timestamps();
        });
    

        // database/migrations/[timestamp]_create_talks_table.php
    

        Schema::create('talks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('speaker_name');
            $table->timestamps();
        });
   
        // database/migrations/[timestamp]_create_attendances_table.php
    
            Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('talk_id')->constrained();
            $table->timestamp('check_in_time');
            $table->timestamps();
        });
   
        // database/migrations/[timestamp]_create_surveys_table.php
    
          Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('talk_id')->constrained();
            $table->timestamps();
        });
   

        // database/migrations/[timestamp]_create_questions_table.php
    
  
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained()->onDelete('cascade');
            $table->string('question_text');
            $table->enum('type', ['multiple_choice', 'text', 'rating']);
            $table->json('options')->nullable(); // Para preguntas de opción múltiple
            $table->timestamps();
        });
   

        // database/migrations/[timestamp]_create_survey_responses_table.php
    
   
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('question_id')->constrained();
            $table->text('response');
            $table->timestamps();
        });
  
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('surveys');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('survey_responses');
        
    }
};
