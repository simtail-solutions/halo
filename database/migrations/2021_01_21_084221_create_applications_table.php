<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->integer('applicant_id')->nullable(); 
            $table->integer('user_id');  //referrer id
            $table->integer('loanAmount');
            $table->string('loanTerm');
            $table->string('frequency');
            $table->string('employment');
            $table->string('residentialType');
            $table->integer('resTimeY')->nullable();
            $table->integer('resTimeM')->nullable();
            $table->string('otherAddress')->nullable();
            $table->integer('empTimeY')->nullable();
            $table->integer('empTimeM')->nullable();
            $table->string('prevOccupation')->nullable();
            $table->string('prevEmployer')->nullable();
            $table->integer('prevEmployerTimeY')->nullable();
            $table->integer('prevEmployerTimeM')->nullable();
            $table->integer('income');
            $table->string('incomeFreq');
            $table->integer('partnerIncome')->nullable();
            $table->string('partnerIncomeFreq')->nullable();
            $table->integer('rentMortgageBoard');
            $table->string('rentFreq');
            $table->string('rentShared');
            $table->string('referenceName');
            $table->string('referencePhone');
            $table->string('referenceSuburb');
            $table->string('numCreditCards');
            $table->string('numPersonalLoans');
            $table->string('numMortgages');
            $table->string('category')->default('Incomplete');
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
        Schema::dropIfExists('applications');
    }
}
