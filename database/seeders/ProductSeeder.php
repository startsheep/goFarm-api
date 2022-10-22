<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id' => 1,
            'title' => 'coba sih',
            'slug' => 'coba-sih',
            'price' => '1500',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque molestias, adipisci enim nostrum, iste quis voluptate error natus, fuga dolorum perferendis. Molestiae consequuntur numquam nam porro sequi distinctio deserunt et.',
            'image' => fake('id')->imageUrl(),
            'status' => 1,
            'created_by' => 1
        ]);

        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'category_id' => 1,
                'title' => fake('id')->jobTitle(),
                'slug' => fake('id')->jobTitle(),
                'price' => '1500',
                'description' => fake('id')->paragraph(3),
                'image' => fake('id')->imageUrl(),
                'status' => 1,
                'created_by' => 1
            ]);
        }
    }
}
