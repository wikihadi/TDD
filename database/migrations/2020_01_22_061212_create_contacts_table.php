<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_name')->nullable();
            $table->string('name');
            $table->string('organization')->nullable();
            $table->string('group')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('tel')->nullable();
            $table->string('intercom')->nullable();
            $table->string('address')->nullable();
            $table->string('web')->nullable();
            $table->date('dob')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
