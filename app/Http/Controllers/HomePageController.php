<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $books = Book::all()->where('is_available', true);

        if ($request->has('find') && $request->get('find')) {

            $param = $request->get('find');

            $books = $books->where('name', 'LIKE', "%{$param}%");
        }

        $books = $books->load('authors');

        dd($books);

        return view('home', [
            'books' => $books,
        ]);
    }

}
