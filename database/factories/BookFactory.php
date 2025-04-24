<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;


    protected static array $titles = [
        'The Laravel Guide',
        'Mastering PHP',
        'Clean Code with Laravel',
        'Advanced Eloquent',
        'MVC Demystified',
        'API Development with Laravel',
        'Laravel Testing Handbook',
        'The Artisan’s Journey',
        'From Blade to Vue',
        'Fullstack Laravel Mastery',
    ];

    protected static array $authors = [
        'Jane Developer',
        'John Artisan',
        'Eloise Query',
        'Sam Stack',
        'Clara Controller',
        'Victor Vue',
        'Tessa Test',
        'Robert Refactor',
        'Paula PHP',
        'Max Model',
    ];

    protected static int $index = 0;

    public function definition(): array
    {
        $i = self::$index++;

        return [
            'title' => self::$titles[$i % count(self::$titles)],
            'author' => self::$authors[$i % count(self::$authors)],
            'created_at' => now()->subDays(rand(10, 1000)),
            'updated_at' => now(),
        ];
    }
}
