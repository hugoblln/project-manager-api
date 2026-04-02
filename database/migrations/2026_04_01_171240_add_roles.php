<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $roles = ['admin', 'manager', 'employee'];

        array_map(fn($i) => Role::create(['name' => $i]), $roles);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $roles = ['admin', 'manager', 'employee'];

        Role::whereIn('name', $roles)->delete();
    }
};
