<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Enums\AdType;
use App\Enums\Define;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Advertiser;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdTest extends TestCase
{
    use RefreshDatabase;

    protected $baseUrl = 'api/ad';

    /**
     * get all ads.
     *
     * @return void
     */
    public function test_get_all_ads()
    {
        $advertiser = Advertiser::create(['name' => $this->faker->name(), 'email' => $this->faker->unique()->safeEmail()]);

        $this->json('post', $this->baseUrl.'/all', ['advertiser_id' => $advertiser->id])
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
     * show a ad successfully.
     *
     * @return void
     */
    public function test_category_is_show_successfully() 
    {
        $advertiser = Advertiser::create(['name' => $this->faker->name(), 'email' => $this->faker->unique()->safeEmail()]);
        $category = Category::create(['name' => $this->faker->name()]);

        $ad = Ad::create(
            [
                'advertiser_id' => $advertiser->id,
                'category_id' => $category->id,
                'title' => Str::limit($this->faker->paragraph(), 50),
                'description' => $this->faker->text(),
                'type' => $this->faker->randomElement(AdType::getValues()),
                'start_date' => $this->faker->dateTimeBetween('2021-11-01', now()->addDays(10)->format(Define::DATE_FORMAT))->format(Define::DATE_FORMAT_24),
            ]
        );

        $this->json('get', $this->baseUrl.'/show/'.$ad->id, ['advertiser_id' => $advertiser->id])
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
     * get check advertiser.
     *
     * @return void
     */
    public function test_check_advertiser_ads()
    {
        $this->json('post', $this->baseUrl.'/all', ['advertiser_id' => ''])
        ->assertStatus(Response::HTTP_BAD_REQUEST)
        ->assertJsonStructure(
            [
                "status",
                "message",
                "data"
            ]
        );
    }
}
