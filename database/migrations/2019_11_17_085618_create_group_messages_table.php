<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content', 199);
            $table->unsignedInteger('from_id');

            $table->unsignedInteger('group_id');

            $table->unsignedTinyInteger('status')->default(1)->comment('1消息正常2测回的消息');;
            $table->unsignedTinyInteger('content_type')->comment('消息类型1文本2表情3文件4图片');
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
        Schema::dropIfExists('group_messages');
    }
}
