<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('Book show')){
            return redirect()->back()->with('warning', 'You do not have the permission to complete the operation');
        }
        $books = Book::with(['category'])->get();
        return view('dashboard.books.index', compact('books'));
    }

    public function create()
    {
        if(!Auth::user()->can('Book create')){
            return redirect()->back()->with('warning', 'You do not have the permission to complete the operation');
        }

        $categories = Category::all();
        return view('dashboard.books.add', compact('categories'));
    }


    public function store(BookRequest $request)
    {
        if(!Auth::user()->can('Book create')){
            return redirect()->back()->with('warning', 'You do not have the permission to complete the operation');
        }

        // return $request;
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publish_date' => $request->publish_date,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return redirect()->route('book.index')->with('success', 'New book is added');
    }

    public function edit(Book $book)
    {
        if(!Auth::user()->can('Book update')){
            return redirect()->back()->with('warning', 'You do not have the permission to complete the operation');
        }

        $categories = Category::all();
        return view('dashboard.books.edit', compact('categories', 'book'));
    }


    public function update(BookRequest $request, string $id)
    {
        if(!Auth::user()->can('Book update')){
            return redirect()->back()->with('warning', 'You do not have the permission to complete the operation');
        }

        // return $id;
        $book = Book::findOrFail($id)->first();

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publish_date' => $request->publish_date,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return redirect()->route('book.index')->with('success', 'The book is updated');
        
    }


    public function destroy(Book $book)
    {
        if(!Auth::user()->can('Book delete')){
            return redirect()->back()->with('warning', 'You do not have the permission to complete the operation');
        }

        $book->delete();
        return redirect()->back()->with('success', 'The book is deleted');
    }
}
