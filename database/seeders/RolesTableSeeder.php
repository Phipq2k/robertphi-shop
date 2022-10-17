<?php

namespace Database\Seeders;

use App\Models\RoleModel;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleModel::truncate();
        RoleModel::create(['role_name'=>'admin']);
        RoleModel::create(['role_name'=>'author']);
        RoleModel::create(['role_name'=>'user']);
    }
}
