<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = $request->all();
        $book['uuid'] = (string) Str::uuid();

        if($request->hasFile('book_image')){
            /**
             * 01
            */
            // $book['book_image'] = $request->file('book_image')->store('books');
            /**
             * 02
             */
            // $book['book_image'] = $request->file('book_image')->getClientOriginalName();
            // $request->file('book_image')->storeAs('folder_books', $book['book_image']);
            /**
             * 03
             */
            // $book['book_image'] = time() . '_' . $request->file('book_image')->getClientOriginalName();
            // $request->file('book_image')->storeAs('folder_books', $book['book_image']);
            /**
             * 04
             */
            $book['book_image'] = time() . '_' . $request->file('book_image')->getClientOriginalName();
            $request->file('book_image')
                ->storeAs('book_folder/' . auth()->id(), $book['book_image']);
        }

        Book::create($book);
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
