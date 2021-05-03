<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('application_id');
            //$table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
            $table->string('apptitle');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('status')->nullable();
            $table->string('dependants')->default('0');
            $table->string('streetaddress');
            $table->string('suburb');
            $table->string('state');
            $table->integer('postcode')->length(4);
            $table->string('phone');
            $table->string('email');
            $table->date('DOB')->nullable();
            $table->string('currentDL')->nullable();
            $table->integer('DLnumber')->nullable();
            $table->integer('MCnumber');
            $table->string('occupation');
            $table->string('employername');
            $table->string('employercontactnumber');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
        
    }
}
