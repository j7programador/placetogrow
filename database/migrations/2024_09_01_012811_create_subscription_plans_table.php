<?php

use App\Constants\BillingCycle;
use App\Constants\CurrencyEnum;
use App\Constants\TypeSubscriptionEnum;
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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('amount');
            $table->enum('currency', CurrencyEnum::toArray());
            $table->integer('subscription_expiration')->nullable();
            $table->enum('billing_cycle', BillingCycle::toArray());
            $table->enum('type', TypeSubscriptionEnum::toArray());
            $table->unsignedInteger('process_identifier')->nullable();
            $table->foreignId('site_id');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
