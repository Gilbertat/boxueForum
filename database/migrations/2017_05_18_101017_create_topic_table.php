<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index(); // 标题
            $table->text('content'); // 详情
            $table->integer('user_id')->unsigned()->default(0)->index(); // 发帖人
            $table->integer('category_id')->unsigned()->default(0)->index(); // 分类
            $table->integer('reply_count')->default(0)->index(); // 回复数
            $table->integer('view_count')->unsigned()->default(0)->index(); // 查看数
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
        Schema::dropIfExists('topics');
    }
}
