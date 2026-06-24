<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'kelola user']);
        Permission::create(['name' => 'kelola kamar']);
        Permission::create(['name' => 'kelola transaksi']);
        Permission::create(['name' => 'lihat laporan']);

    }
}
