<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('sender_name');
            $table->string('email');
            $table->longText('content');

            $table->bigInteger('application_id')->unsigned();
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');

            $table->bigInteger('email_channel_id')->unsigned();
            $table->foreign('email_channel_id')->references('id')->on('email_channels')->onDelete('cascade');

            $table->boolean('sent')->default(false);
            $table->date('sent_at')->nullable();

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
        Schema::dropIfExists('email_notifications');
    }
}
