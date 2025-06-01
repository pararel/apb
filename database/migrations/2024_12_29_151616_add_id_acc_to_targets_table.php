<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('targets', function (Blueprint $table) {
            $table->foreignId('id_acc')->constrained('accounts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('targets', function (Blueprint $table) {
            $table->dropForeign(['id_acc']);
            $table->dropColumn('id_acc');
        });
    }
};