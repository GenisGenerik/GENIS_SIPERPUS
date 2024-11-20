<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Bookshelf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $data["bookshelf"] = Bookshelf::get() ;
        // dd($data);
        return view("books.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title'=>'required|max:255',
                'author'=>'required|max:255',
                'year'=>'required|integer|max:2024',
                'publisher'=>'required|max:255',
                'city'=>'required|max:50',
                'cover'=>'required',
                'bookshelf_id'=>'required'
            ]
            );
            if($request->hasFile('cover'))
            {
                $path = $request->file('cover')->storeAs(
                    'public/cover_buku','cover_buku_'.time().'.' . $request->file('cover')->extension()
                );
                $validated['cover']=basename($path);
            }
            Book::create($validated);
        $notification = array(
            'message'=>'Data Berhasil di hapus',
            'alert-type'=>'succes'
        );
        return redirect('book')->with($notification);
        if($request->save == true)return redirect()->route('book')->with($notification);
        else return redirect()->route('book.create')->with($notification);
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
        $data["bookshelf"] = Bookshelf::get() ;
        $data["book"] = Book::findOrFail($id) ;
        // dd($data);
        return view("books.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        $validated = $request->validate(
            [
                'title'=>'required|max:255',
                'author'=>'required|max:255',
                'year'=>'required|integer|max:2024',
                'publisher'=>'required|max:255',
                'city'=>'required|max:50',
                'cover'=>'required',
                'bookshelf_id'=>'required'
            ]
            );
            if($request->hasFile('cover'))
            {
                if($book->cover != null)
                {
                    Storage::delete('public/cover_buku'. $request->old_cover);
                }
                $path = $request->file('cover')->storeAs(
                    'public/cover_buku','cover_buku_'.time().'.' . $request->file('cover')->extension()
                );
                $validated['cover']=basename($path);
            }
            $book->update($validated);
        $notification = array(
            'message'=>'Data Berhasil di hapus',
            'alert-type'=>'succes'
        );
        return redirect()->route('book')->with($notification);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        Storage::delete('public/cover_buku'.$book->cover);
        $book->delete();
        $notification = array(
            'message'=>'Data Berhasil di hapus',
            'alert-type'=>'succes'
        );
        return redirect()->route('book')->with($notification);
    }
}
