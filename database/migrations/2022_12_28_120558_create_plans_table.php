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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('extensionId')->nullable();
            $table->string('description')->nullable();
            $table->string('statusId')->nullable();
            $table->string('assigneeId')->nullable();
            $table->string('priorityId')->nullable();
            $table->string('dueDate')->nullable();
            $table->string('spendHours')->nullable();
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
        Schema::dropIfExists('plans');
    }
};
