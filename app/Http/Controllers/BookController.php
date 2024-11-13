<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['books'] = Book::with('bookshelf')->get();
        //
        return view("books.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["bookshelf"] = Book::get() ;
        return view("books.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Book::create([
        'title'=>$request->title,
        'author'=>$request->author,
        'year'=>$request->year,
        'publisher'=>$request->publisher,
        'city'=>$request->city,
        'cover'=>$request->cover,
        'bookshelf_id'=>$request->bookshelf_id
        ]);
        $notification = array(
            'message'=>'Data Berhasil di hapus',
            'alert-type'=>'succes'
        );
        return redirect('book')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
