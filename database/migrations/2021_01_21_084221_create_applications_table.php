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
            $table->integer('applicant_id'); 
            $table->integer('user_id');  //referrer id
            $table->integer('loanAmount')->nullable();
            $table->string('loanTerm')->nullable();
            $table->string('frequency')->nullable();
            $table->string('employment')->nullable();
            $table->string('residentialType')->nullable();
            $table->string('resTimeY')->nullable();
            $table->string('resTimeM')->nullable();
            $table->string('otherAddress')->nullable();
            $table->string('empTimeY')->nullable();
            $table->string('empTimeM')->nullable();
            $table->string('prevOccupation')->nullable();
            $table->string('prevEmployer')->nullable();
            $table->string('prevEmployerTimeY')->nullable();
            $table->string('prevEmployerTimeM')->nullable();
            $table->integer('income')->nullable();
            $table->string('incomeFreq')->nullable();
            $table->integer('partnerIncome')->nullable();
            $table->string('partnerIncomeFreq')->nullable();
            $table->integer('rentMortgageBoard')->nullable();
            $table->string('rentFreq')->nullable();
            $table->string('rentShared')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('api_token', '20')->unique();
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
