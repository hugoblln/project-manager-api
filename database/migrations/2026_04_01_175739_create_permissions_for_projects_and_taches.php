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
        $permissions = ['create taches', 'update taches', 'view taches', 'viewAny taches', 'delete taches',
        'create projects', 'update projects', 'view projects', 'viewAny projects', 'delete projects',
        'manage-all'     
        ];

        array_map(fn($i) => Permission::create(['name' => $i]), $permissions);

        $admin = Role::findByName('admin');
        $manager = Role::findByName('manager');
        $employee = Role::findByName('employee');

        $admin->givePermissionTo('manage-all');
        $manager->givePermissionTo($permissions);
        $employee->givePermissionTo('view projects', 'viewAny projects', 'update taches', 'view taches', 'viewAny taches');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $permissions = ['create taches', 'update taches', 'view taches', 'viewAny taches', 'delete taches',
        'create projects', 'update projects', 'view projects', 'viewAny projects', 'delete projects',
        'manage-all'     
    ];


    $admin = Role::findByName('admin');
    $manager = Role::findByName('manager');
    $employee = Role::findByName('employee');

    $admin->revokePermissionTo('manage-all');
    $manager->revokePermissionTo($permissions);
    $employee->revokePermissionTo(['view projects', 'viewAny projects', 'update taches', 'view taches', 'viewAny taches']);

    Permission::whereIn('name', $permissions)->delete();
    }
};
