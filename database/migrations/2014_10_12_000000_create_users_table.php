<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name',20);
            $table->string('phone',20)->nullable();
            $table->string('open_id',199)->nullable()->comment('微信open_id');
            $table->string('union_id',199)->nullable()->comment('微信union_id');
            $table->string('avatar_url',199)->nullable()->comment('用户头像');
            $table->string('location',30)->nullable()->comment('用户地理位置');
            $table->unsignedTinyInteger('status')->default(1)->comment('用户是否被禁用1否2被禁用');
            $table->string('password');
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
