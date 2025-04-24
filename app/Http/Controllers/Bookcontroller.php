<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', '');

        $books = Book::query();

        if ($title) {
            $books->where('title', 'like', '%' . $title . '%');
        }

        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6months' => $books->popularLast6Months(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6months' => $books->highestRatedLast6Months(),
            default => $books->latest()
        };

        $books = $books->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->get();

        return view('books.index', ['books' => $books]);
    }

    public function show(Book $book)
    {
        $cacheKey = 'book:' . $book->id;

        $book = cache()->remember(
            $cacheKey,
            3600,
            fn() =>
            Book::with([
                'reviews' => fn($query) => $query->latest()
            ])->withAvgRating()->withReviewsCount()->findOrFail($book->id)
        );

        return view('books.show', ['book' => $book]);
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
        ]);

        $book = Book::create($data);

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Book added! You can now add a review.');
    }



    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {

    }
}
