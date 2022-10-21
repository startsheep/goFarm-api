<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Seeders\Traits\DisableForeignKey;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use DisableForeignKey, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Makanan', 'Minuman'];
        $this->disableForeignKeys();
        $this->truncate('categories');
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'status' => 1
            ]);
        }
        $this->enableForeignKeys();
    }
}
