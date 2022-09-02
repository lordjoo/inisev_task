<?php

namespace Database\Factories;

use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteFactory extends Factory
{
    protected $model = Website::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ];
    }
}
