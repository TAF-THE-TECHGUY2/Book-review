<?php

use App\Models\Book;
use App\Models\Review;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn() => redirect()->route('books.index'));


Route::resource('books', BookController::class)
    ->only(['index', 'show']);

Route::get('books/{book}/reviews/create', [ReviewController::class, 'create'])
    ->name('books.reviews.create');

Route::post('books/{book}/reviews', [ReviewController::class, 'store'])
    ->name('books.reviews.store')
    ->middleware('throttle:reviews');


Route::get('/sample-books', function () {

    Book::factory()
        ->count(10)
        ->create()
        ->each(function ($book) {

            $book->reviews()->createMany(
                Review::factory()->count(3)->make()->toArray()
            );
        });

    return redirect()->route('books.index')->with('success', '10 books with reviews added!');
})->name('books.sample');



Route::resource('books', BookController::class)->only(['index', 'show']);
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');

