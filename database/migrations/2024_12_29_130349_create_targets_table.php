<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->enum('parameter', ['power', 'cost']);
            $table->date('start');
            $table->date('end');
            $table->integer('days');
            $table->double('value');
            $table->double('average');
            $table->double('usage');
            $table->integer('countDays');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('targets');
    }
};
