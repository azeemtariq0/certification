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
        Schema::create('training_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_no')->unique();
            $table->string('verification_id')->unique();
            $table->string('candidate_name')->index();
            $table->string('candidate_id')->nullable();
            $table->string('course_title');
            $table->string('course_category')->index(); // Auditor, Lead Auditor, Internal Auditor, Awareness Training, IMS Auditor, IMS Lead Auditor, Other
            $table->string('standard')->index(); // ISO 9001:2015, ISO 14001:2015, ISO 45001:2018, IMS, etc.
            $table->string('training_duration')->nullable(); // e.g. 5 Days (40 Hours)
            $table->string('training_provider')->default('S2 Certification Academy');
            $table->string('issuing_organization')->default('S2 Certification');
            $table->date('completion_date');
            $table->date('issue_date');
            $table->date('valid_until')->nullable();
            $table->string('status')->default('VALID')->index(); // VALID, EXPIRED, CANCELLED, SUSPENDED, REVOKED
            $table->string('certificate_file')->nullable(); // Path to PDF / Image
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_certificates');
    }
};
