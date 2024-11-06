<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(
            [
                "name" => "pustakawan",
            ],

        );
        Permission::create([
            "name" => "edit_user",
        ]);
        Role::create(
            [
                "name" => "Mahasiswa",
            ],

        );
        Permission::create(
            [
                "name" => "View_Book",
            ]
        );
    }
}
