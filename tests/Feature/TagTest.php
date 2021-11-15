<?php

namespace Tests\Feature;

use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    protected $baseUrl = 'api/tag';

    /**
     * get all tags.
     *
     * @return void
     */
    public function test_get_all_tags()
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
     * create a tag successfully.
     *
     * @return void
     */
    public function test_tag_is_created_successfully() 
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

        $this->assertDatabaseHas('tags', $payload);
    }

    /**
     * update a tag successfully.
     *
     * @return void
     */
    public function test_tag_is_updated_successfully() 
    {
        $tag = tag::create(['name' => $this->faker->name()]);

        $payload = [
            'name' => $this->faker->name(),
        ];

        $this->json('put', $this->baseUrl.'/update/'.$tag->id, $payload)
             ->assertStatus(Response::HTTP_CREATED)
             ->assertJsonStructure(
                [
                    "status",
                    "message",
                    "data"
                ]
             );

        $this->assertDatabaseHas('tags', $payload);
    }

    /**
     * show a tag successfully.
     *
     * @return void
     */
    public function test_tag_is_show_successfully() 
    {
        $tag = tag::create(['name' => $this->faker->name()]);

        $this->json('get', $this->baseUrl.'/show/'.$tag->id)
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
     * delete a tag successfully.
     *
     * @return void
     */
    public function test_tag_is_delete_successfully() 
    {
        $tag = tag::create(['name' => $this->faker->name()]);

        $this->json('delete', $this->baseUrl.'/delete/'.$tag->id)
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
     * create a tag without name.
     *
     * @return void
     */
    public function test_create_tag_without_name() 
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
     * create a tag with duplicate name.
     *
     * @return void
     */
    public function test_create_tag_with_duplicate_name() 
    {
        tag::create(['name' => 'tag 1']);

        $payload = [
            'name' => 'tag 1',
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
