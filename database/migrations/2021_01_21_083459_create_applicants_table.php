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
            $table->string('apptitle');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('status')->nullable();
            $table->string('dependants')->default('0');
            $table->string('streetaddress')->nullable();
            $table->string('suburb')->nullable();
            $table->string('state')->nullable();
            $table->integer('postcode')->length(4)->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('birth_day')->length(2)->nullable();
            $table->string('birth_month')->length(3)->nullable();
            $table->integer('birth_year')->length(4)->nullable();
            $table->boolean('currentDL')->nullable();
            $table->integer('DLnumber')->nullable();
            $table->string('DLimage')->nullable();
            $table->integer('MCnumber')->nullable();
            $table->string('MCimage')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employername')->nullable();
            $table->string('employercontactnumber')->nullable();
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
