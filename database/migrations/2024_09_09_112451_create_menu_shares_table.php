<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_shares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shared_by')->nullable();  // اگر بخواهید اطلاعات کاربری که اشتراک گذاشته را هم داشته باشید

            // تعریف کلیدهای خارجی با onDelete('cascade')
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shared_by')->references('id')->on('users')->onDelete('set null');  // اگر حذف شود مقدار null بگیرد

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
        Schema::dropIfExists('menu_shares');
    }
}
