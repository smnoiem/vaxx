<?php

use App\Models\Dose;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGivenByToDosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doses', function (Blueprint $table) {
            $table->unsignedBigInteger('given_by');
            $table->timestamps();
        });

        Schema::table('doses', function (Blueprint $table) {
            $table->foreign('given_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doses', function (Blueprint $table) {
            $table->dropForeign('doses_given_by_foreign');
            $table->dropColumn('given_by');
            $table->dropTimestamps();
        });
    }
}
