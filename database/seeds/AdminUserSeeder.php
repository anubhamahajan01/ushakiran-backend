<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'uuid'          => generate_uuid(),
            'name'          => 'admin',
            'email'         => 'admin@ushakiran.org.in',
            'password'      => bcrypt('abc123'),
            'phone'         => '9876543210',
            'address'       => '22 Street',
            'is_admin'      => 1,
        ]);
    }
}
