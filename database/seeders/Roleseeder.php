<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'administrator'
        ]);
        $client = Role::create([
            'name' => 'client'
        ]);

        Permission::create([
            'name' => 'admin'
        ])->assignRole($admin);

        Permission::create([
            'name' => 'client'
        ])->assignRole($client);
    }
}
