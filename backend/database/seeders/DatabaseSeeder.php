<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ]);

        // Call all module seeders
        $this->seedModuleSeeder();
    }

    private function seedModuleSeeder()
    {
        // Path to modules_statuses.json
        $moduleStatusesPath = base_path('modules_statuses.json');

        if (file_exists($moduleStatusesPath)) {
            $moduleStatuses = json_decode(file_get_contents($moduleStatusesPath), true);

            foreach ($moduleStatuses as $moduleName => $isEnabled) {
                if ($isEnabled) {
                    $moduleSeeder = "Modules\\$moduleName\\Database\\Seeders\\{$moduleName}DatabaseSeeder";

                    if (class_exists($moduleSeeder)) {
                        $this->call($moduleSeeder);
                        $this->command->info("Seeded: $moduleSeeder");
                    } else {
                        $this->command->warn("Seeder not found for module: $moduleName");
                    }
                }
            }
        } else {
            $this->command->error('modules_statuses.json file not found!');
        }
    }
}
