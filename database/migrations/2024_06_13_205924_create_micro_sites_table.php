<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 30)->unique();
            $table->string('name', 100)->unique();
            $table->enum('document_type', array_column(\App\Constants\DocumentTypeEnum::cases(), 'name'));
            $table->string('document', 30);
            $table->foreignId('category_id')->constrained();
            $table->enum('type_microsite', array_column(\App\Constants\TypeMicrositeEnum::cases(), 'name'));
            $table->timestamp('enabled_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('img_url', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
