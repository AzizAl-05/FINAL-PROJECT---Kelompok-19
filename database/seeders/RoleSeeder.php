<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $petugas = Role::create(['name' => 'petugas']);

        $admin->givePermissionTo(Permission::all());

        $petugas->givePermissionTo([
            'kelola kamar',
            'kelola transaksi',
        ]);
    }
}
