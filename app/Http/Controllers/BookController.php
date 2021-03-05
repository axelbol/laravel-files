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
    // public function store(Request $request)
    // {
    //     $book = $request->all();
    //     $book['uuid'] = (string) Str::uuid();

    //     if($request->hasFile('book_image')){
    //         /**
    //          * 01 documentation way
    //         */
    //         $book['book_image'] = $request->file('book_image')->store('books');
    //         /**
    //          * 02 save just with the name
    //          */
    //         $book['book_image'] = $request->file('book_image')->getClientOriginalName();
    //         $request->file('book_image')->storeAs('folder_books', $book['book_image']);
    //         /**
    //          * 03 save with time ahead and original name
    //          */
    //         $book['book_image'] = time() . '_' . $request->file('book_image')->getClientOriginalName();
    //         $request->file('book_image')->storeAs('folder_books', $book['book_image']);
    //         /**
    //          * 04 save in a folder with the id of the user
    //          */
    //         $book['book_image'] = time() . '_' . $request->file('book_image')->getClientOriginalName();
    //         $request->file('book_image')
    //             ->storeAs('book_folder/' . auth()->id(), $book['book_image']);
    //     }

    //     Book::create($book);
    //     return redirect()->route('books.index');
    // }

    public function download($uuid)
    {
        $book = Book::where('uuid', $uuid)->firstOrFail();
        $pathToFile = storage_path("app/public/subfolder/$book->id/" . $book->book_image);
        // return response()->download($pathToFile);
        return response()->file($pathToFile);
    }

    /**
     * Store option number 5
     */
    public function store(Request $request)
    {
        $book = Book::create([
            'uuid' => (string) Str::orderedUuid(),
            'title' => $request->title,
        ]);
        if($request->hasFile('book_image'))
        {
            $image = $request->file('book_image')->getClientOriginalName();
            $request->file('book_image')
                ->storeAs('subfolder/' . $book->id, $image);
            $book->update(['book_image' => $image]);
        }
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
        return view('books.edit', compact('book'));
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
        $book->update($request->only(['uuid', 'title']));
        if($request->hasFile('book_image'))
        {
            $image = $request->file('book_image')->getClientOriginalName();
            $request->file('book_image')
                ->storeAs('subfolder/' . $book->id, $image);
            if($book->book_image != '')
            {
                unlink(storage_path('app/public/subfolder/' . $book->id . '/' . $book->book_image));
            }
            $book->update(['book_image' => $image]);
        }
        return redirect()->route('books.index');
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
