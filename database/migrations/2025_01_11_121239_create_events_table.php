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
        // Tabla events
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('location')->nullable();
            $table->enum('type', ['conference', 'workshop', 'webinar'])->nullable(); // Clasificación
            $table->foreignId('user_id')->constrained(); // Organizador
            $table->timestamps();
            $table->softDeletes(); // Eliminación lógica
        });

        // Tabla speakers
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->text('bio')->nullable(); // Biografía
            $table->string('photo')->nullable(); // Ruta a la foto del ponente
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla talks
        Schema::create('talks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('location')->nullable(); // Ubicación de la charla
            $table->string('qr_code')->nullable(); // Código QR de la charla
            $table->foreignId('event_id')->references('id')->on('events')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('speaker_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        
            // Validación de no superposición de horarios entre charlas del mismo evento
            $table->unique(['event_id', 'start_time', 'end_time']);
        });
        

        // Tabla attendances
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('talk_id')->constrained();
            $table->timestamp('check_in_time');
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla surveys
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('talk_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla questions
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained()->onDelete('cascade');
            $table->string('question_text');
            $table->enum('type', ['multiple_choice', 'text', 'rating']);
            $table->json('options')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla survey_responses
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('question_id')->constrained();
            $table->text('response');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('survey_responses');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('surveys');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('talks');
        Schema::dropIfExists('speakers');
        Schema::dropIfExists('events');
    }
};

