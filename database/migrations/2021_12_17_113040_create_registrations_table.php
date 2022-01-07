<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            //$table->id();
            $table->string('nid', 17)->primary();
            $table->date('dob');
            $table->string('phone', 15);
            //$table->foreign('center_id')->references('id')->on('centers'); // column must be created first.
            $table->foreignId('center_id')->constrained(); //shorthand
            $table->timestamp('registered_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
