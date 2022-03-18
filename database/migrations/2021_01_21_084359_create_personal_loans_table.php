<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalloansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_loans', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->string('financeCompany');
            $table->string('balance');
            $table->string('repayment');
            $table->enum('frequency', ['Weekly','Fortnightly','Monthly']);
            $table->string('consolidate');
            $table->string('joint');
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
        Schema::dropIfExists('personal_loans');
    }
}
