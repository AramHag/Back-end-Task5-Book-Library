<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class FavoriteController extends Controller
{
    //

    public function index(Request $request)
    {
        $books = Book::join('categories', 'categories.id', 'books.category_id')->get();
        if ($request->main_category) {
            $books = $books->where('parent_id', $request->main_category);
        }
        if ($request->category_id) {
            $books = $books->where('category_id', $request->category_id);
        }

        $categories = Category::all();
        return view('website.welcome', compact('books', 'categories'));
    }


    public function addFavorite(string $user_id, string $book_id)
    {
        // return $book_id;

        // return $user_id;
        $book = Book::where('id', $book_id)->first();
        $user = User::where('id', $user_id)->first();
        $all_favorites = DB::table('favorites')->get();
        foreach ($all_favorites as $favorite) {
            if ($favorite->user_id == $user_id && $favorite->book_id == $book_id) {
                return redirect()->back()->with('info', 'This book already in your favorites.');
            }
        }

        $user->books()->attach($book);
        return redirect()->back()->with('success', "The book $book->title had been added to favorites.");
    }
    public function removeFavorite(string $user_id, string $book_id)
    {
        // return $book_id;

        // return $user_id;
        $book = Book::where('id', $book_id)->first();
        $user = User::where('id', $user_id)->first();

        $user->books()->detach($book);

        return redirect()->back()->with('danger', "The book $book->title had been removed from favorites.");
    }



    public function favorite(string $user_id)
    {

        // return $user = User::where('id', $user_id)->first();
        $books = DB::table('favorites')
            ->join('books', 'book_id', 'id')
            ->where('favorites.user_id', '=', $user_id)
            ->get();

        return view('website.favorite', compact('books'));
    }
}
