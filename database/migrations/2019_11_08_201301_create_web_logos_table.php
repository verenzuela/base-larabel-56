<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebLogosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('web_logos', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('web_setting_id')->unsigned();
      $table->string('name', 45)->unique();
      $table->string('display_name', 45);
      $table->integer('height')->nullable();
      $table->integer('width')->nullable();
      $table->boolean('status')->nullable();
      $table->string('img_url', 200);
      $table->string('img_name', 200)->nullable();
      $table->string('img_type', 10)->nullable();
      $table->boolean('custom')->nullable()->default(false);
      $table->timestamps();

      $table->foreign('web_setting_id')->references('id')->on('web_settings')->onUpdate('restrict')->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('web_logos');
  }
}
