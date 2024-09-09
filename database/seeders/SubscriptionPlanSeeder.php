<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;
use App\Models\Site;

class SubscriptionPlanSeeder extends Seeder
{
    public function run()
    {
        $site = Site::where('type_microsite', 'SUSCRIPTION')->first();
        if (!$site) {
            $this->command->error('There is no site "subscription".');
            return;
        }

        SubscriptionPlan::factory()
            ->count(1)
            ->create([
                'site_id' => $site->id,
            ]);
    }
}
