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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('certificate_no')->unique();
            $table->string('standard');
            $table->text('scope');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('status')->default('Active');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('certification_body')->default('S2 Certification');
            $table->string('accreditation_body')->default('PNAC');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
