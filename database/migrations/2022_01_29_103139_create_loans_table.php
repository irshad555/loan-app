<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            

            $table->decimal('amount', 8, 2);
            $table->decimal('arrangement_fee', 8, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('term');
            $table->string('frequency', 15);
            $table->tinyinteger('is_completed')->default(0);
            $table->timestamps();
            // Foreigns
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
