<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    protected static array $reviewTexts = [
        'This book was very informative and well-written.',
        'Good content but could be more detailed in some chapters.',
        'Not quite what I expected, but still useful.',
        'Loved the practical examples and structure.',
        'Highly recommended for Laravel beginners!',
        'A must-read for modern PHP developers.',
        'Well-organized and easy to follow.',
        'Too advanced for my level, but insightful.',
        'Helpful reference for day-to-day development.',
        'Clear, concise, and packed with tips.'
    ];


    protected static int $index = 0;

    public function definition(): array
    {
        $i = self::$index++;

        return [
            'book_id' => null,
            'review' => self::$reviewTexts[$i % count(self::$reviewTexts)],
            'rating' => rand(3, 5),
            'created_at' => now()->subDays(rand(10, 700)),
            'updated_at' => now(),
        ];
    }

    public function good()
    {
        return $this->state(fn(array $attrs) => ['rating' => rand(4, 5)]);
    }

    public function average()
    {
        return $this->state(fn(array $attrs) => ['rating' => 3]);
    }

    public function bad()
    {
        return $this->state(fn(array $attrs) => ['rating' => rand(1, 2)]);
    }
}
