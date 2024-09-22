<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // رابطه خود ارجاعی.یعنی هر منو می‌تواند والد یا فرزند منوی دیگر باشد
            $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade');
            // در صورت حذف یک رکورد در جدول والد (مثلاً حذف منوی والد یا کاربر)، تمام رکوردهای فرزند مرتبط به آن نیز حذف خواهند شد.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
