<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->seedRoles();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
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
};
