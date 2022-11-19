<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Traits\DisableForeignKey;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use DisableForeignKey, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('users');

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mailinator.com',
            'phone' => '11111',
            'role_id' => 1
        ]);

        User::factory()->create([
            'email' => 'merchant@mailinator.com',
            'phone' => '22222',
            'role_id' => 2
        ]);

        User::factory()->create([
            'email' => 'driver@mailinator.com',
            'phone' => '33333',
            'role_id' => 3
        ]);

        User::factory()->create([
            'email' => 'customer@mailinator.com',
            'phone' => '44444',
            'role_id' => 4
        ]);

        $this->enableForeignKeys();
    }
}
