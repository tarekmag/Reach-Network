<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected $baseUrl = 'api/category';

    /**
     * get all categories.
     *
     * @return void
     */
    public function test_get_all_categories()
    {
        $this->json('get', $this->baseUrl.'/all')
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                "status",
                "message",
                "hasMorePages",
                "nextPageUrl",
                "total",
                "perPage",
                "currentPage",
                "data"
            ]
        );
    }

    /**
     * create a category successfully.
     *
     * @return void
     */
    public function test_category_is_created_successfully() 
    {
        $payload = [
            'name' => $this->faker->name(),
        ];

        $this->json('post', $this->baseUrl.'/add', $payload)
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJsonStructure(
            [
                "status",
                "message",
                "data"
            ]
        );

        $this->assertDatabaseHas('categories', $payload);
    }

    /**
     * update a category successfully.
     *
     * @return void
     */
    public function test_category_is_updated_successfully() 
    {
        $category = Category::create(['name' => $this->faker->name()]);

        $payload = [
            'name' => $this->faker->name(),
        ];

        $this->json('put', $this->baseUrl.'/update/'.$category->id, $payload)
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJsonStructure(
            [
                "status",
                "message",
                "data"
            ]
        );

        $this->assertDatabaseHas('categories', $payload);
    }

    /**
     * show a category successfully.
     *
     * @return void
     */
    public function test_category_is_show_successfully() 
    {
        $category = Category::create(['name' => $this->faker->name()]);

        $this->json('get', $this->baseUrl.'/show/'.$category->id)
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                "status",
                "message",
                "data"
            ]
        );
    }

    /**
     * delete a category successfully.
     *
     * @return void
     */
    public function test_category_is_delete_successfully() 
    {
        $category = Category::create(['name' => $this->faker->name()]);

        $this->json('delete', $this->baseUrl.'/delete/'.$category->id)
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonStructure(
                [
                    "status",
                    "message",
                    "data"
                ]
             );
    }

    /**
     * create a category without name.
     *
     * @return void
     */
    public function test_create_category_without_name() 
    {
        $payload = [
            'name' => '',
        ];

        $this->json('post', $this->baseUrl.'/add', $payload)
             ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
             ->assertJsonStructure(
                [
                    "status",
                    "message",
                    "data"
                ]
            );
    }

    /**
     * create a category with duplicate name.
     *
     * @return void
     */
    public function test_create_category_with_duplicate_name() 
    {
        Category::create(['name' => 'Category 1']);

        $payload = [
            'name' => 'Category 1',
        ];

        $this->json('post', $this->baseUrl.'/add', $payload)
             ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
             ->assertJsonStructure(
                [
                    "status",
                    "message",
                    "data"
                ]
            );
    }
}
