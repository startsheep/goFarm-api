<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    public function can_get_list_product_without_login()
    {
        $this->getJson(route('api.product.index'))->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function can_get_list_product_with_login()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $this->getJson(route('api.product.index'))->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_get_list_product_by_search()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $response = $this->getJson(route('api.product.index', [
            'search' => 'coba sih'
        ]));

        $result = collect($response->json()['data']);
        $this->assertTrue($result->where('title', 'coba sih')->count() > 0);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_get_list_product_by_category_id()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $response = $this->getJson(route('api.product.index', [
            'category' => 1
        ]));

        $result = collect($response->json()['data'][0]);

        $this->assertTrue($result->where('id', 1)->count() > 0);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_get_list_product_by_category_name()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $response = $this->getJson(route('api.product.index', [
            'category' => 'Makanan'
        ]));

        $result = collect($response->json()['data'][0]);

        $this->assertTrue($result->where('name', 'Makanan')->count() > 0);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_get_list_product_by_user_id()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $response = $this->getJson(route('api.product.index', [
            'user' => '1'
        ]));

        $result = collect($response->json()['data'][0]);

        $this->assertTrue($result->where('id', 1)->count() > 0);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_get_list_product_by_user_name()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $response = $this->getJson(route('api.product.index', [
            'user' => 'admin'
        ]));

        $result = collect($response->json()['data'][0]);

        $this->assertTrue($result->where('name', 'admin')->count() > 0);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_get_list_product_by_price_range()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $response = $this->getJson(route('api.product.index', [
            'price_from' => '1000',
            'price_to' => '2000'
        ]));

        $result = collect($response->json()['data'][0]);

        $this->assertTrue($result->get('price') == '1500');

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_create_product_with_empty_request()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $this->postJson(route('api.product.store'), [
            'category_id' => 1,
            'title' => '',
            'slug' => '',
            'price' => '',
            'description' => '',
            'status' => 1,
            'image' => UploadedFile::fake()->create('image.png'),
            'created_by' => 1
        ])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    /** @test */
    public function can_create_product()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $this->postJson(route('api.product.store'), [
            'category_id' => 1,
            'title' => 'coba sih',
            'slug' => 'coba-sih',
            'price' => '1500',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque molestias, adipisci enim nostrum, iste quis voluptate error natus, fuga dolorum perferendis. Molestiae consequuntur numquam nam porro sequi distinctio deserunt et.',
            'status' => 1,
            'image' => UploadedFile::fake()->create('image.png'),
            'created_by' => 1
        ])->assertStatus(Response::HTTP_CREATED);

        $product = Product::where('title', 'coba sih')->first();
        $this->assertNotNull($product);

        $product->delete();
    }

    /** @test */
    public function can_show_product()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $product = Product::create([
            'category_id' => 1,
            'title' => 'coba sih',
            'slug' => 'coba-sih',
            'price' => '1500',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque molestias, adipisci enim nostrum, iste quis voluptate error natus, fuga dolorum perferendis. Molestiae consequuntur numquam nam porro sequi distinctio deserunt et.',
            'status' => 1,
            'image' => 'image.png',
            'created_by' => 1
        ]);

        $this->getJson(route('api.product.show', $product->id))->assertStatus(Response::HTTP_OK);

        $product = Product::where('title', 'coba sih')->first();
        $this->assertNotNull($product);

        $product->delete();
    }

    /** @test */
    public function can_update_product()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $product = Product::create([
            'category_id' => 1,
            'title' => 'coba sih',
            'slug' => 'coba-sih',
            'price' => '1500',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque molestias, adipisci enim nostrum, iste quis voluptate error natus, fuga dolorum perferendis. Molestiae consequuntur numquam nam porro sequi distinctio deserunt et.',
            'status' => 1,
            'image' => 'image.png',
            'created_by' => 1
        ]);

        $this->putJson(route('api.product.update', $product->id), [
            'category_id' => 1,
            'title' => 'coba sih',
            'slug' => 'coba-sih',
            'price' => '1500',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque molestias, adipisci enim nostrum, iste quis voluptate error natus, fuga dolorum perferendis. Molestiae consequuntur numquam nam porro sequi distinctio deserunt et.',
            'status' => 1,
            'image' => UploadedFile::fake()->create('image.png'),
            'created_by' => 1
        ])->assertStatus(Response::HTTP_OK);

        $product = Product::where('title', 'coba sih')->first();
        $this->assertNotNull($product);

        $product->delete();
    }

    /** @test */
    public function can_update_product_with_empty_request()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $product = Product::create([
            'category_id' => 1,
            'title' => 'coba sih',
            'slug' => 'coba-sih',
            'price' => '1500',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque molestias, adipisci enim nostrum, iste quis voluptate error natus, fuga dolorum perferendis. Molestiae consequuntur numquam nam porro sequi distinctio deserunt et.',
            'status' => 1,
            'image' => 'image.png',
            'created_by' => 1
        ]);

        $this->putJson(route('api.product.update', $product->id), [
            'category_id' => 1,
            'title' => '',
            'slug' => '',
            'price' => '',
            'description' => '',
            'status' => 1,
            'image' => UploadedFile::fake()->create('image.png'),
            'created_by' => 1
        ])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    /** @test */
    public function can_update_status_product()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $product = Product::create([
            'category_id' => 1,
            'title' => 'coba sih 3',
            'slug' => 'coba-sih',
            'price' => '1500',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque molestias, adipisci enim nostrum, iste quis voluptate error natus, fuga dolorum perferendis. Molestiae consequuntur numquam nam porro sequi distinctio deserunt et.',
            'status' => 1,
            'image' => 'image.png',
            'created_by' => 1
        ]);

        $this->putJson(route('api.product.update.status', $product->id), [
            'status' => 1
        ])->assertStatus(Response::HTTP_OK);

        $product = Product::where('title', 'coba sih 3')->first();
        $this->assertTrue($product->status == 1);
        $this->assertNotNull($product);

        $product->delete();
    }

    /** @test */
    public function can_delete_product()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $product = Product::create([
            'category_id' => 1,
            'title' => 'coba sih 2',
            'slug' => 'coba-sih',
            'price' => '1500',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque molestias, adipisci enim nostrum, iste quis voluptate error natus, fuga dolorum perferendis. Molestiae consequuntur numquam nam porro sequi distinctio deserunt et.',
            'status' => 1,
            'image' => 'image.png',
            'created_by' => 1
        ]);

        $this->deleteJson(route('api.product.delete', $product->id))->assertStatus(Response::HTTP_OK);

        $product = Product::where('title', 'coba sih 2')->first();
        $this->assertNull($product);
    }
}
