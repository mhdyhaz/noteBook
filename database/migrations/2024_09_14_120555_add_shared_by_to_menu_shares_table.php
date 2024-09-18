<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSharedByToMenuSharesTable extends Migration
{
    public function up()
    {
        Schema::table('menu_shares', function (Blueprint $table) {
            $table->foreignId('shared_by')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('menu_shares', function (Blueprint $table) {
            $table->dropForeign(['shared_by']);
            $table->dropColumn('shared_by');
        });
    }
};