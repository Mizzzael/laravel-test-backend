<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idImmobile')->unique();
            $table->foreign('idImmobile')->references('id')->on('immobiles');
            $table->string('city');
            $table->string('address');
            $table->string('neighborhood');
            $table->string('number');
            $table->string('complement')->nullable();
            $table->string('document');
            $table->integer('personType');
            $table->string('email');
            $table->string('name');
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('contracts');
    }
}
