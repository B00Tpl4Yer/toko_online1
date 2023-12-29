<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Membuat role
         Role::create(['name' => 'admin']);
         Role::create(['name' => 'operator']);
         Role::create(['name' => 'user']);
        //   $admin = Role::create(['name' => 'admin']);
        //   $operator = Role::create(['name' => 'operator']);
        //   $user = Role::create(['name' => 'user']);


        //   // Membuat permission
        //   $mengaturuser = Permission::create(['name' => 'mengaturuser']);
        //   $mengaturoperator = Permission::create(['name'=> 'mengaturoperator']);
        //   $mengaturmanajemenstok= Permission::create(['name'=> 'mengaturmanajemenstok']);
        //   $mengaturkualitaskeaslian = Permission::create(['name'=> 'mengaturkualitaskeaslian']);
        //   $mengaturmasalahlogistik = Permission::create(['name'=> 'mengaturmasalahlogistik']);
        //   $mengaturmanagemenpembayarandanpengiriman = Permission::create(['name'=> 'mengaturmanagemenpembayarandanpengiriman']);
        //   $membuatpesanan = Permission::create(['name'=>'membuatpesanan']);
        //   $melakukanpembayaran = Permission::create(['name'=> 'melakukanpembayaran']);
        //   // Memberikan permission ke role
        //   $admin->givePermissionTo(
        //       $mengaturuser,
        //       $mengaturoperator,

        //   );

        //   $operator->givePermissionTo(
        //       $mengaturmanajemenstok,
        //       $mengaturkualitaskeaslian,
        //       $mengaturmasalahlogistik,
        //       $mengaturmanagemenpembayarandanpengiriman,
        //   );

        //   $user->givePermissionTo(
        //       $membuatpesanan,
        //       $melakukanpembayaran,
        //   );

          // Pengguna tidak terdaftar mungkin tidak memiliki permission tertentu, tergantung pada kebijakan aplikasi.
    }
}
