<?php

use App\Constants\StatusEnum;
use App\Constants\TypeSubscriptionEnum;
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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->text('description')->nullable();
            $table->enum('status', StatusEnum::toArray());
            $table->text('status_message')->nullable();
            $table->string('request_id')->nullable();
            $table->enum('type', TypeSubscriptionEnum::toArray());
            $table->string('token');
            $table->string('sub_token');
            $table->string('price');
            $table->timestamp('expiration_date');
            $table->json('additional_data');
            $table->foreignId('site_id');
            $table->foreign('site_id')
                ->references('id')
                ->on('sites');

            $table->foreignId('customer_id');
            $table->foreign('customer_id')
                ->references('id')
                ->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
