<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_chapters', function (Blueprint $table) {
            $table->id();
            $table->string('tenChuongHoc');
            $table->integer('trangThai');
            $table->integer('giaoVienID');
            $table->unsignedBigInteger('my_course_id');
            $table->foreign('my_course_id')->references('id')->on('my_courses')->onDelete('cascade');
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
        Schema::dropIfExists('my_chapters');
    }
}
