<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email',191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->default('avatar.jpg')->nullable();
            $table->string('mobile')->nullable();
            $table->string('insurance')->nullable();
            $table->string('card')->nullable();
            $table->string('bank')->nullable();
            $table->string('account_code')->nullable();
            $table->string('account_code')->nullable();
            $table->string('role')->nullable();
            $table->string('etiquette')->nullable();
            $table->text('comment')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
