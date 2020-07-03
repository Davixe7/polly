<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
          $table->id();
          $table->timestamps();
          $table->string('name');
          $table->string('image')->nullable();
          $table->string('url')->nullable();
          $table->text('iframe')->nullable();
          $table->unsignedInteger('duration')->default(60);
          $table->boolean('is_active')->default(0);
          $table->boolean('enabled')->default(0);
          $table->unsignedBigInteger('user_id')->nullable();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
