<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->enum('info', ['account', 'post', 'target', 'feedback']);
            $table->foreignId('id_acc')->constrained('accounts')->onDelete('cascade');
            $table->foreignId('id_post')->default(0)->constrained('posts')->onDelete('cascade');
            $table->foreignId('id_target')->default(0)->constrained('targets')->onDelete('cascade');
            $table->foreignId('id_fb')->default(0)->constrained('feedbacks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('histories');
    }
};
