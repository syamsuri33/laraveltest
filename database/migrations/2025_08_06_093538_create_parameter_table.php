<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParameterTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up(): void
  {
    Schema::create('parameter', function (Blueprint $table) {
      $table->string('param_code', 64)->primary();
      $table->string('param_name', 64);
      $table->string('created_by', 32);
      $table->timestamp('created_time');
      $table->string('updated_by', 32)->nullable();
      $table->timestamp('updated_time')->nullable();
    });
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('parameter');
  }
}
