<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('companyId')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('passportNo')->nullable();
            $table->string('country')->nullable();
            $table->date('appointDate')->nullable();
            $table->time('reportTime')->nullable();
            $table->string('designation')->nullable();
            $table->string('jobLocation',1000)->nullable();
            $table->decimal('salary')->nullable();
            $table->string('currency')->nullable();
            $table->string('barCode')->unique();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('isPrinted')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('companyId')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seekers');
    }
}
