<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
        return response([
            'books' => $books,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vaildateData = $request->validate([
            "isbn" => "required",
            "title" => "required|string|max:255",
            "language" => "required|string|max:50",
            "publisher" => "required|string|max:255",
            "author" => "required|string|max:255",
            "user_id" => "required",
        ]);
        //Start transaction!
        DB::beginTransaction();
        try {
            $books = Book::create($vaildateData);
        } catch (ValidationException $e) {
            DB::rollback();
            throw response([
                "message" => $e,
            ], 202);
        } catch (Exception $e) {
            DB::rollback();
            throw response([
                "message" => $e,
            ], 202);
        }
        DB::commit();

        return response([
            'books' => $books,
        ], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Book::where('id', $id)->exists()) {
            $book = Book::where('id', $id)->get();
        } else {
            return response()->json([
                "message" => "No data to display",
            ], 404);
        }
        return response()->json([
            "book" => $book,
        ], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "isbn" => "required",
            "title" => "required|string|max:255",
            "language" => "required|string|max:50",
            "publisher" => "required|string|max:255",
            "author" => "required|string|max:255",
            "user_id" => "required",
        ]);
        DB::beginTransaction();
        try {
            if (Book::where('id', $id)) {
                $book = new Book;
                $book->isbn = $request->isbn;
                $book->title = $request->title;
                $book->language = $request->language;
                $book->publisher = $request->publisher;
                $book->author = $request->author;
                $book->user_id = $request->user_id;
                $book->save();
            } else {
                return response()->json([
                    "message" => "NO data to delete",
                ], 404);
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "message" => $e,
            ], 202);
        }
        return response()->json([
            "message" => "Details updated successfully",
        ], 201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            if (Book::where('id', $id)->exists()) {
                Book::destroy($id);
            } else {
                return response()->json([
                    'message' => "No data to delete",
                ], 404);
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "message" => $e,
            ], 202);
        }
        DB::commit();
        return response()->json([
            "message" => "Details deleted successfully",
        ], 202);
    }
}
