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
            'email' => 'admin@example.com',
            'phone' => '11111',
            'role_id' => 1
        ]);

        User::factory()->create([
            'email' => 'pedagang@example.com',
            'phone' => '22222',
            'role_id' => 2
        ]);

        User::factory()->create([
            'email' => 'pembeli@example.com',
            'phone' => '33333',
            'role_id' => 3
        ]);

        $this->enableForeignKeys();
    }
}
