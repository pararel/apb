<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->enum('is_admin', ['yes', 'no'])->default('no');
            $table->integer('all_targets')->default(0);
            $table->integer('current_targets')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('posts')->default(0);
            $table->integer('post_liked')->default(0);
        });
    }

    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn(['is_admin', 'all_targets', 'current_targets', 'likes', 'posts', 'post_liked']);
        });
    }
};
