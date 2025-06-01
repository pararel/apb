<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->dropForeign(['id_post']);
            $table->dropForeign(['id_target']);
            $table->dropForeign(['id_fb']);
            $table->dropColumn(['id_post', 'id_target', 'id_fb']);
        });
    }

    public function down()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->foreignId('id_post')->default(0)->constrained('posts')->onDelete('cascade');
            $table->foreignId('id_target')->default(0)->constrained('targets')->onDelete('cascade');
            $table->foreignId('id_fb')->default(0)->constrained('feedbacks')->onDelete('cascade');
        });
    }
};
