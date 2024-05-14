<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['category'])->get();
        return response()->json([
            'data' => $books,
            'code' => 200,
            'message' => "Return All The Books with The  categories",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publish_date' => $request->publish_date,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return response()->json([
            'data' => $book,
            'code' => 201,
            'message' => "New book $book->title is added",
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, string $id)
    {
        $book = Book::findOrFail($id)->first();

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publish_date' => $request->publish_date,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return response()->json([
            'data' => $book,
            'code' => 200,
            'message' => "New $book->title book is update",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::where('id', $id)->first();
        $book->delete();
        return response()->json([
            'data' => $book,
            'code' => 200,
            'message' => "New $book->title book is deleted",
        ]);
    }
}
