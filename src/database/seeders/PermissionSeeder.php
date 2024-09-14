<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           // สร้าง permission
           $permission = Permission::create(['name' => 'view reports']);

           // หา user ที่เป็น admin (สมมุติว่าคือ user ที่มี id เท่ากับ 1)
           $admin = User::find(1);
   
           // ให้ permission นี้กับ admin
           if ($admin) {
               $admin->givePermissionTo($permission);
           }
    }
}
