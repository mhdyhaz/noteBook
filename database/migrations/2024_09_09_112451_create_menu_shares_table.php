<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuSharesTable extends Migration
{
    public function up()
    {
        Schema::create('menu_shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            // Prevent deletion if referenced
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->foreignId('shared_by')->nullable()->constrained('users')->onDelete('set null');  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_shares');
    }
}
