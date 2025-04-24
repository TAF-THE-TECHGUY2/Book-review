@extends('layouts.app')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Add a New Book</h1>

    <form method="POST" action="{{ route('books.store') }}" class="space-y-4">
        @csrf

        <div>
            <label for="title" class="block font-medium text-slate-700">Title</label>
            <input type="text" name="title" id="title" class="input" required>
        </div>

        <div>
            <label for="author" class="block font-medium text-slate-700">Author</label>
            <input type="text" name="author" id="author" class="input" required>
        </div>

        <button type="submit" class="btn">Add Book</button>
    </form>
@endsection
