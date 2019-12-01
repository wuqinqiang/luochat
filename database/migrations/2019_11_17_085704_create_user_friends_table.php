<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_friends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('from_id')->comment('申请人');

            $table->unsignedInteger('to_id')->comment('被申请的对象');

            $table->timestamp('last_show')->nullable()->comment('最后一次查看对方信息的时间');
            $table->unsignedTinyInteger('status')->default(1)->comment('1正常2被对方拉黑');
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
        Schema::dropIfExists('user_friends');
    }
}
