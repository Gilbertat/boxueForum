<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content_raw'); // 回复内容mark-down版
            $table->text('content_html'); // html 版
            $table->integer('topic_id')->unsigned()->default(0)->index(); // 帖子ID
            $table->integer('user_id')->unsigned()->default(0)->index();  // 用户ID
            $table->enum('is_blocked', ['yes', 'no'])->default('no')->index();
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
        Schema::dropIfExists('replies');
    }
}
