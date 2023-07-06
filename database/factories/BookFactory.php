<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            "description" => $this->faker->text(),
            "title" => $this->faker->word,
            "pages" => $this->faker->numberBetween(1, 900),
            "year" => $this->faker->year()
        ];
    }
}
