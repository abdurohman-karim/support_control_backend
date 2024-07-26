<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->string('message_id');
            $table->integer('user_id');
            $table->string('chat_name');
            $table->string('chat_id');
            $table->boolean('is_done')->default(0);
            $table->boolean('is_deleted')->default(0);
            $table->boolean('is_archived')->default(0);
            $table->boolean('is_replied')->default(0);
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
        Schema::dropIfExists('tasks');
    }
}
