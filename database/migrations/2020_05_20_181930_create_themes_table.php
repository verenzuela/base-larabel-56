<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('themes', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('web_setting_id')->unsigned();
      $table->string('name', 15)->unique();
      $table->boolean('custom_principal_color')->nullable()->default(false);
      $table->string('principal_color', 8)->nullable();
      $table->boolean('custom_pagination')->nullable()->default(false);
      $table->integer('pagination')->nullable();
      $table->boolean('status')->default(0);
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
    Schema::dropIfExists('themes');
  }
}
