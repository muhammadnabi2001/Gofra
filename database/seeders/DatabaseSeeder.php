<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Role;
use App\Models\RoleUsers;
use App\Models\User;
use App\Models\UserOrder;
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

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        
        
       
        
        

    }
}
