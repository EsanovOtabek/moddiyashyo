<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Esanov Otabek',
            'phone'=> '+998932360433',
            'login' => 'esanov',
            'password' => bcrypt('123456'),
            'role' => 'admin',
        ]);

        $role = Role::create([
            'name' => 'admin',
            'description' => 'Super Admin',
        ]);
    }
}
