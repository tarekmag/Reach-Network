<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Enums\AdType;
use App\Enums\Define;
use App\Models\Category;
use App\Models\Advertiser;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'advertiser_id' => Advertiser::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => Str::limit($this->faker->paragraph(), 50),
            'description' => $this->faker->text(),
            'type' => $this->faker->randomElement(AdType::getValues()),
            'start_date' => $this->faker->dateTimeBetween('2021-11-01', now()->addDays(10)->format(Define::DATE_FORMAT))->format(Define::DATE_FORMAT_24),
        ];
    }
}
