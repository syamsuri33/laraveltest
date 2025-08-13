<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParameterDetailTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up(): void
  {
    Schema::create('parameter_detail', function (Blueprint $table) {
      $table->string('detail_code', 64)->primary();
      $table->string('detail_name', 64);
      $table->string('param_code', 64);
      $table->string('description', 128);
      $table->string('created_by', 32);
      $table->timestamp('created_time');
      $table->string('updated_by', 32)->nullable();
      $table->timestamp('updated_time')->nullable();

      $table->foreign('param_code')->references('param_code')->on('parameter')->onDelete('cascade');
    });
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('parameter_detail');
  }
}
