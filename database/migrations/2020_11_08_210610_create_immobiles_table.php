<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immobiles', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('CEP');
            $table->string('state');
            $table->string('address');
            $table->string('number')->nullable();
            $table->string('city');
            $table->string('complement')->nullable();
            $table->string('neighborhood');
            $table->boolean('solded')->default(false);
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
        Schema::dropIfExists('immobiles');
    }
}
