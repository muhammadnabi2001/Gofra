<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use App\Models\PermissionGroup;
use App\Models\Permit;

class GeneratePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate permissions from route prefixes and names';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routes = Route::getRoutes();
        $createdPermissions = 0;

        foreach ($routes as $route) {
            if ($route->getPrefix()) {
                $prefix = ltrim($route->getPrefix(), '/');
                $name = $route->getName();

                if ($name) {
                    $group = PermissionGroup::firstOrCreate([
                        'name' => $prefix
                    ]);

                    $permission = Permit::firstOrCreate([
                        'name' => $name,
                        'path' => $name,
                        'group_id' => $group->id
                    ]);

                    if ($permission->wasRecentlyCreated) {
                        $this->info("Permission '{$name}' in group '{$prefix}' created.");
                        $createdPermissions++;
                    } else {
                        $this->info("Permission '{$name}' already exists in group '{$prefix}'.");
                    }
                }
            }
        }

        if ($createdPermissions === 0) {
            $this->info('No new permissions created.');
        } else {
            $this->info("{$createdPermissions} permissions created successfully.");
        }
    }
}
