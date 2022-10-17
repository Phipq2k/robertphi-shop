<?php

namespace Database\Seeders;

use App\Models\AdminModel;
use App\Models\RoleModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Lệnh tắt kiểm tra khóa ngoại
        DB::statement("SET foreign_key_checks = 0");

        /**
         * Tạo database mẫu
         */
        AdminModel::truncate();
        $adminRoles = RoleModel::where('role_name','admin')->first();
        $authorRoles = RoleModel::where('role_name','author')->first();
        $userRoles = RoleModel::where('role_name','user')->first();



        // $admin = AdminModel::create([
        //     'admin_name' => 'Robert Phi',
        //     'admin_email' => 'robertphipq@gmail.com',
        //     'admin_phone' => '0941915884',
        //     'admin_password' => md5('12345678')
        // ]);

        // $author = AdminModel::create([
        //     'admin_name' => 'Nguyễn Hữu Đức',
        //     'admin_email' => 'ducnguyen@gmail.com',
        //     'admin_phone' => '012345678',
        //     'admin_password' => md5('12345678')
        // ]);

        // $user = AdminModel::create([
        //     'admin_name' => 'Lương Thiện Kiệt',
        //     'admin_email' => 'kietluong@gmail.com',
        //     'admin_phone' => '0987654321',
        //     'admin_password' => md5('12345678')
        // ]);
        $robertPhi = AdminModel::create([
            'admin_name' => 'Robert Phi',
            'admin_email' => 'phipq@gmail.com',
            'admin_phone' => '0941915884',
            'admin_password' => md5('12345678')
        ]);
        $userfake = AdminModel::factory()->count(20)->create();

        //Phân quyền 

        $robertPhi->roles()->attach($adminRoles);
        // $author->roles()->attach($authorRoles);
        // $user->roles()->attach($userRoles);
        
       for($i = 0; $i < $userfake->count(); $i++) {
           $arrRoles = [$adminRoles,$authorRoles,$userRoles];
            $userfake[$i]->roles()->attach($arrRoles[rand(0,2)]);
       }
    }
}
