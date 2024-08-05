<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ChangeLocale extends Command
{
    protected $signature = 'app:change-locale {locale}';
    protected $description = 'Change the application locale';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $locale = $this->argument('locale');

        // Get the path to the .env file
        $envPath = base_path('.env');

        // Get the current content of the .env file
        $envContent = File::get($envPath);

        // Replace the APP_LOCALE value with the new locale
        $envContent = preg_replace(
            "/^APP_LOCALE=.*$/m",
            "APP_LOCALE={$locale}",
            $envContent
        );

        // Save the updated content back to the .env file
        File::put($envPath, $envContent);

        // Output a success message
        $this->info("Application locale has been changed to: {$locale}");
    }
}
