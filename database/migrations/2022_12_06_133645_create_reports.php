<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('reports', function (Blueprint $table) {
      $table->id();
      $table->string('title', 200);
      $table->string('report_link')->nullable();
      $table->date('date_from');
      $table->date('date_to');
      $table->foreignId('user_id')->constrained();
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
    Schema::dropIfExists('reports');
  }
};