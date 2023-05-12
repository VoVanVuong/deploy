<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_courses', function (Blueprint $table) {
            $table->id();
            $table->string('tenKhoaHoc');
            $table->string('moTa');
            $table->string('linkVideo');
            $table->integer('giaCa');
            $table->integer('trangThai');
            $table->integer('giaoVienID');
            $table->string('maHoaDon');
            $table->string('maKichHoat');
            $table->date('ngayHetHan')->nullable();
            $table->date('ngayMua');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('my_courses');
    }
}
