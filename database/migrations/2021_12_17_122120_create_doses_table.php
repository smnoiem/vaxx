<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doses', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_nid', 17);
            $table->foreign('recipient_nid')->references('nid')->on('registrations');
            $table->foreignId('vaccine_id')->constrained();
            $table->string('dose_type');
            $table->date('scheduled_date');
            $table->date('taken_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doses');
    }
}
