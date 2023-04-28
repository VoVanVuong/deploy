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
            $table->id();
            $table->string('email')->unique();
            $table->string('soDienThoai');
            $table->string('password');
            $table->string('hoTen');
            $table->enum('gioiTinh', ['Nam', 'Nữ']);
            $table->string('ngaySinh')->nullable();
            $table->string('diaChi');
            $table->string('avatar')->nullable();
            $table->integer('trangThai');
            $table->integer('phanQuyen');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_seen')->nullable();
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
