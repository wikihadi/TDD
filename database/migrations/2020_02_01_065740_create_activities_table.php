<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('code')->default(0);
            $table->string('note')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_name')->nullable();
//            $table->integer('to_user')->nullable();
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id')->references('id')->on('contacts');
//            $table->integer('media_id')->nullable();
//            $table->integer('post_id')->nullable();
//            $table->integer('re_id')->nullable();
//            $table->integer('fin_id')->nullable();
//            $table->integer('reply_id')->nullable();
//            $table->integer('duration')->nullable();
//            $table->string('unit')->nullable();
//            $table->string('pic')->nullable();
//            $table->boolean('forcedBox')->nullable()->default(0);
            $table->string('url')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
