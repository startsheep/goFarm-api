<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /** @test */
    public function can_get_list_category_without_login()
    {
        $this->getJson(route('api.category.index'))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function can_get_list_category_with_login()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $this->getJson(route('api.category.index'))
            ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_get_list_category_name_makanan()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $response = $this->getJson(
            route('api.category.index', [
                'search' => 'makanan'
            ])
        );

        $result = collect($response->json()['data']);
        $this->assertTrue($result->where('name', 'Makanan')->count() > 0);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function can_get_category_by_id()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $category = Category::create([
            'name' => 'Udang Presto',
            'status' => 1
        ]);

        $response = $this->getJson(route('api.category.show', $category->id))
            ->assertStatus(Response::HTTP_OK);

        $result = collect($response->json());

        $this->assertTrue($result->where('name', 'Udang Presto')->count() > 0);

        $category->delete();
    }

    /** @test */
    public function can_create_category()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $this->postJson(route('api.category.store'), [
            'name' => 'Udang Presto 2',
            'status' => 1
        ])->assertStatus(Response::HTTP_CREATED);

        $category = Category::where('name', 'Udang Presto 2')->first();

        $this->assertNotNull($category);

        $category->delete();
    }

    /** @test */
    public function can_create_category_with_same_name()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        Category::create([
            'name' => 'Udang Presto 5',
            'status' => 1
        ]);

        $this->postJson(route('api.category.store'), [
            'name' => 'Udang Presto 5',
            'status' => 1
        ])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    /** @test */
    public function can_create_category_with_empty_request()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $this->postJson(route('api.category.store'), [
            'name' => '',
            'status' => 1
        ])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    /** @test */
    public function can_update_category()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $category = Category::create([
            'name' => 'Udang Presto 3',
            'status' => 1
        ]);

        $this->putJson(route('api.category.update', $category->id), [
            'name' => 'Bandeng Presto',
            'status' => 0
        ])->assertStatus(Response::HTTP_OK);

        $category = Category::where('name', 'Udang Presto 3')->first();
        $this->assertNull($category);

        $category = Category::where('name', 'Bandeng Presto')->first();
        $this->assertNotNull($category);

        $category->delete();
    }

    /** @test */
    public function can_update_category_with_empty_request()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $category = Category::create([
            'name' => 'Udang Presto 6',
            'status' => 1
        ]);

        $this->putJson(route('api.category.update', $category->id), [
            'name' => '',
            'status' => 0
        ])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    /** @test */
    public function can_delete_category()
    {
        Sanctum::actingAs(User::find(1), ['admin']);

        $category = Category::create([
            'name' => 'Udang Presto 4',
            'status' => 1
        ]);

        $this->deleteJson(route('api.category.delete', $category->id))
            ->assertStatus(Response::HTTP_OK);

        $category = Category::where('name', 'Udang Presto 4')->first();
        $this->assertNull($category);
    }
}
