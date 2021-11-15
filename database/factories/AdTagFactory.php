<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ad_id' => Ad::inRandomOrder()->first()->id,
            'tag_id' => Tag::inRandomOrder()->first()->id,
        ];
    }
}
