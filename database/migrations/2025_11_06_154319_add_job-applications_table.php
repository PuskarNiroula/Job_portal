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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->string("resume")->nullable();
            $table->unsignedBigInteger('user_id')->index("fk_job_applications_user_id_users_id");
            $table->unsignedBigInteger('post_id')->index("fk_job_applications_post_id_post_id");
            $table->id();
            $table->enum('status', ['pending', 'rejected', 'accepted'])->default('pending');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('post_id')->references('job_id')->on('available_jobs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
