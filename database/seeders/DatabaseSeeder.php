<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedRegions();
        $this->seedRoles();
    }

    private function seedRegions(): void
    {
        $countries = Country::factory()->count(5)->create();

        /** @var Country $country*/
        foreach ($countries as $country)
        {
            City::factory()->count(5)->create(['country_id' => $country->id]);
        }
    }

    private function seedRoles(): void
    {
        Permission::create(['name' => 'cities-show']);
        Permission::create(['name' => 'application-show']);
        Permission::create(['name' => 'application-create']);
        Permission::create(['name' => 'application-reject']);
        Permission::create(['name' => 'application-merge']);
        Permission::create(['name' => 'user-attach-role']);

        /** @var Role $admin */
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        /** @var Role $user */
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(['cities-show', 'application-create']);
    }
}
