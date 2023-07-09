<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

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
            'user_id' => Auth::id(),
            "description" => $this->faker->text(),
            "title" => $this->faker->word,
            "pages" => $this->faker->numberBetween(1, 900),
            "year" => $this->faker->year()
        ];
    }
}
